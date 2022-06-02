<?php

namespace App\Controllers;

use PhpParser\Node\Stmt\Echo_;
use App\Models\Order_model;
use App\Models\Detail_order_model;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use CodeIgnter\Database\BaseBuilder;

class Bayar extends BaseController
{
    private $get_time;
    private $idlog;
    private $jScript;



    public function index($nomeja)
    {
        $data = [
            'nomeja' => $nomeja
        ];
        return view('pages/get_data', $data);
    }

    public function qr()
    {
        $new = $_POST["data"];
        $new = json_decode($new, true);
        $new = json_decode($new, true);
        $finalprice = 0;
        foreach ($new as $key => $value) {
            $finalprice += $new[$key]['price'];
            $detail_menu[$key]['name'] = $new[$key]['name'];
            $detail_menu[$key]['id'] = $new[$key]['id'];
            $detail_menu[$key]['count'] = $new[$key]['count'];
            $detail_menu[$key]['price'] = $new[$key]['price'];
            $detail_menu[$key]['basePrice'] = $new[$key]['basePrice'];
        }
        // echo "<pre>";
        // print_r($detail_menu);





        $cek_data = $this->cek_id($_POST['idlog']);

        if (!isset($cek_data[0]['order_id'])) {

            $data_api['finalprice'] = $finalprice;
            $data_api['idlog'] = $_POST["idlog"];
            $get_api = $this->getCode($data_api);
            $kode_api = $get_api['kode'];
            $tanggal_api = $get_api['waktu'];


            $data_qr['kode'] = $kode_api;
            $data_qr['idlog'] = $_POST["idlog"];
            $get_qr = $this->createQR($data_qr);



            $order_model = new Order_model();
            $order_model->save([
                'order_id' => $_POST["idlog"],
                'table' => $_POST["nomeja"],
                'price' => $finalprice,
                'status' => 'UNPAID',
                'qris' => $kode_api,
                'tanggal_api' => $tanggal_api
            ]);
            foreach ($detail_menu as $key => $value) {
                $detail_order_model = new Detail_order_model();
                $detail_order_model->save([
                    'order_id' => $_POST["idlog"],
                    'menu_id' => $detail_menu[$key]["id"],
                    'menu_name' => $detail_menu[$key]["name"],
                    'base_price' => $detail_menu[$key]["basePrice"],
                    'jumlah' => $detail_menu[$key]["count"],
                    'total_price' => $detail_menu[$key]["price"]
                ]);
            }

            $data = [
                'idlog' => $_POST["idlog"],
                'nomeja' => $_POST["nomeja"],
                'total' => $finalprice,
                'qr' => $get_qr
            ];
            return view('pages/bayar', $data);
        } else {
            if ($cek_data[0]['status'] == "PAID") {
                echo "  <script>
                        localStorage.removeItem('shoppingCart');
                        </script>";
                return view('pages/nota');
            } else {
                $data_qr['kode'] = $cek_data[0]['qris'];
                $data_qr['idlog'] = $_POST["idlog"];
                $get_qr = $this->createQR($data_qr);
                $data = [
                    'idlog' => $_POST["idlog"],
                    'nomeja' => $_POST["nomeja"],
                    'total' => $finalprice,
                    'qr' => $get_qr
                ];
                return view('pages/bayar', $data);
            }
        }
    }

    protected function getCode($data_api)
    {
        $finalprice = $data_api['finalprice'];
        $idlog = $data_api['idlog'];
        $url = "https://qris.id/restapi/qris/show_qris.php?do=create-invoice&apikey=a789789&mID=123456&cliTrxNumber={$idlog}&cliTrxAmount={$finalprice}";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);
        $new_result = json_decode($result, true);
        if ($new_result['status'] == "success") {
            $info['status'] = $new_result['status'];
            $info['kode'] = $new_result['data']['qris_invoiceid'];
            $info['waktu'] = $new_result['data']['qris_request_date'];
            $info['qris_invoiceid'] = $new_result['data']['qris_invoiceid'];
        } else {
            $info['status'] = $new_result['status'];
            $info['status'] = "success";
            $info['kode'] = "00020101021226680016ID.CO.TELKOM.WWW011893600898025599662702150001952559966270303UMI51440014ID.CO.QRIS.WWW0215ID10200211817450303UMI520457325303360540825578.005502015802ID5916InterActive Corp6013KOTA SURABAYA61056013662130509413255111630439B7";
            $info['waktu'] = "2020-08-07 11:13:42";
            $info['qris_invoiceid'] = "413255111";
        }
        return $info;
    }


    protected function createQR($data_qr)
    {
        $kode = $data_qr['kode'];
        $idlog = $data_qr['idlog'];
        $writer = new PngWriter();
        $qrCode = QrCode::create($kode)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        // $label = Label::create("id = " . $idlog)
        // ->setTextColor(new Color(255, 0, 0));
        $result = $writer->write($qrCode, null, null);
        // header('Content-Type: ' . $result->getMimeType());

        $result->saveToFile(WRITEPATH . "uploads\\" . $idlog . ".png");
        return $dataUri = $result->getDataUri();
        //  "<img src='{$result->getDataUri()}'/>";
    }

    public function cek_id($go)
    {
        $builder = $this->db->table('order');
        $result = $builder->getWhere(['order_id' => $go]);
        $row = $result->getResult();
        $array = json_decode(json_encode($row), true);
        return $array;
    }

    public function donlot($idlog)
    {
        return $this->response->download(WRITEPATH . "uploads\\" . $idlog . ".png", null);
    }

    public function cekstatus($go = '', $go2 = '')
    {
        $builder = $this->db->table('order');
        $result = $builder->getWhere(['order_id' => $go2]);
        $row = $result->getResult();
        $array = json_decode(json_encode($row), true);
        if (is_array($array) && count($array) > 0) {
            if ($array[0]['status'] == "PAID") {
                echo "  <script>
                        localStorage.removeItem('shoppingCart');
                        </script>";
                return view('pages/nota');
            } else {

                echo "<script> window.alert('Anda belum melakukan pembayaran!'); window.location.href = '" . base_url($go . '/Bayar') . "'; </script>";
            }
        } else {
            echo "<script> window.alert('Anda belum melakukan pembayaran!'); window.location.href = '" . base_url($go) . "'; </script>";
        }
    }
}
