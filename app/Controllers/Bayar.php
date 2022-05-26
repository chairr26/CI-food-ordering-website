<?php

namespace App\Controllers;

use PhpParser\Node\Stmt\Echo_;
use App\Models\Order_model;
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



    function __construct()
    {
        // $this->get_time = gettimeofday();
        // $this->idlog = $this->get_time['sec'] . $this->get_time['usec'];
        // $this->idlog = '<script type="text/javascript"> var cartItems = localStorage.getItem("idlog"); var jsonString = JSON.stringify(cartItems); document.write (cartItems); </script>';
        // $this->idlog = "<script> document.write(JSON.parse(JSON.stringify(localStorage.getItem('idlog')))); </script>";
    }


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
        }
        // echo "  <script>
        // localStorage.removeItem('shoppingCart');
        // </script>";
        $get_qr = $this->cek_id($_POST['idlog']);




        $data_api['finalprice'] = $finalprice;
        $data_api['idlog'] = $_POST["idlog"];
        $get_api = $this->getCode($data_api);


        $data_qr['kode'] = $get_api;
        $data_qr['idlog'] = $_POST["idlog"];
        $get_qr = $this->createQR($data_qr);


        if (!isset($get_qr[0]['order_id'])) {
            $order_model = new Order_model();
            $order_model->save([
                'order_id' => $_POST["idlog"],
                'table' => $_POST["nomeja"],
                'price' => $finalprice,
                'status' => 'UNPAID',
                'qris' => $get_api
            ]);
        }




        $data = [
            'idlog' => $_POST["idlog"],
            'nomeja' => $_POST["nomeja"],
            'total' => $finalprice,
            'qr' => $get_qr
        ];
        return view('pages/bayar', $data);
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
        if (isset($new_result['data']['qris_content'])) {
            $kode = "00020101021226680016ID.CO.TELKOM.WWW011893600898025599662702150001952559966270303UMI51440014ID.CO.QRIS.WWW0215ID10200211817450303UMI520457325303360540825578.005502015802ID5916InterActive Corp6013KOTA SURABAYA61056013662130509413255111630439B7";
        } else {
            $kode = "00020101021226680016ID.CO.TELKOM.WWW011893600898025599662702150001952559966270303UMI51440014ID.CO.QRIS.WWW0215ID10200211817450303UMI520457325303360540825578.005502015802ID5916InterActive Corp6013KOTA SURABAYA61056013662130509413255111630439B7";
        }
        return $kode;
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
        header('Content-Type: ' . $result->getMimeType());

        $result->saveToFile(WRITEPATH . "uploads\\" . $idlog . ".png");
        return $dataUri = $result->getDataUri();
        //  "<img src='{$result->getDataUri()}'/>";
    }

    public function cek_id($go = '165340989851934')
    {
        $builder = $this->db->table('order');
        $result = $builder->getWhere(['order_id' => $go]);
        $row = $result->getResult();
        $array = json_decode(json_encode($row), true);
        // echo "<pre>";
        // print_r($array);
        return $array;
    }

    public function donlot($idlog)
    {
        return $this->response->download(WRITEPATH . "uploads\\" . $idlog . ".png", null);
    }
}
