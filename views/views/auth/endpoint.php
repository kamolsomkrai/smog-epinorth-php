<?php



/* @var $this \yii\web\View */

use alcea\yii2PrismSyntaxHighlighter\PrismSyntaxHighlighter;
use yii\helpers\Json;

$this->params['breadcrumbs'][] = 'Endpoint';

PrismSyntaxHighlighter::widget([
    'id' => 'json1',
    'theme' => PrismSyntaxHighlighter::THEME_COY,
    'languages' => ['json'],
]);

?>

<style>
    table {
        width: 100%;
        border: 1px solid black;
        border-radius: 5px;
        border-collapse: collapse;
        margin-bottom: 15px;
        margin-top: 20px;
    }
    table tr td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    span .token.punctuation }{

    }
</style>
<h2>Endpoint</h2>
<div class="site-endpoint">
    <table>
        <tr>
            <td colspan="2" style="text-align: center">ส่งข้อมูล</td>
        </tr>
        <tr>
            <td>Endpoint</td>
            <td>https://smog-epinorth.ddc.moph.go.th/web/index.php?r=api/send</td>
        </tr>
        <tr>
            <td>Auth Method</td>
            <td>Basic Auth</td>
        </tr>
        <tr>
            <td>Method</td>
            <td>POST</td>
        </tr>
        <tr>
            <td>Request</td>
            <td>JSON</td>
        </tr>
        <tr>
            <td>Return</td>
            <td>JSON</td>
        </tr>
    </table>
    <h3>Example request data</h3>
    <per>
        <code>
            <strong>Request</strong>
            <p>Request Header:</p>
            Content-type: application/json<br>
            Authorization: Bearer [token]
        </code>
    </per>


    <pre>
        <code class="language-json">
        <?php
        $arr = [
            'hospcode'=>'xxxxx',
            'method'=>'TEST',
            'data'=>[
                [
                    'hospcode' => 'xxxxx',
                    'pid' => '00000',
                    'birth' => '0000-00-00',
                    'sex' => '0',
                    'hn' => '000000',
                    'seq' => '000000',
                    'date_serv' => '0000-00-00',
                    'diagtype' => '01',
                    'diagcode' => 'I10',
                    'clinic' => '0000',
                    'provider' => 'xxxxxxxxxxxxx',
                    'd_update' => '0000-00-00 00:00:00',
                    'cid' => 'xxxxxxxxxxxxx',
                    'appoint' => 'Y',
                ],
                [
                    'hospcode' => 'xxxxx',
                    'pid' => '00000',
                    'birth' => '0000-00-00',
                    'sex' => '0',
                    'hn' => '000000',
                    'seq' => '000000',
                    'date_serv' => '0000-00-00',
                    'diagtype' => '01',
                    'diagcode' => 'I10',
                    'clinic' => '0000',
                    'provider' => 'xxxxxxxxxxxxx',
                    'd_update' => '0000-00-00 00:00:00',
                    'cid' => 'xxxxxxxxxxxxx',
                    'appoint' => 'Y',
                ],
            ],
        ];

        echo Json::encode($arr,JSON_PRETTY_PRINT);
        ?>
            </code>
    </pre>
    <table>
        <tr>
            <td colspan="2" style="text-align: center">ลบข้อมูล</td>
        </tr>
        <tr>
            <td>Endpoint</td>
            <td>https://smog-epinorth.ddc.moph.go.th/web/index.php?r=api/delete</td>
        </tr>
        <tr>
            <td>Auth Method</td>
            <td>Basic Auth</td>
        </tr>
        <tr>
            <td>Method</td>
            <td>POST</td>
        </tr>
    </table>
    <per>
        <code>
            <strong>Request</strong>
            <p>Request Header:</p>
            Content-type: application/json<br>
            Authorization: Bearer [token]<br>
            hcode: xxxx<br>
            date_serv: 0000-00-00
        </code>
    </per>

    <table>
        <tr>
            <td colspan="2" style="text-align: center">รายงาน</td>
        </tr>
        <tr>
            <td>Endpoint</td>
            <td>https://smog-epinorth.ddc.moph.go.th/web/index.php?r=api/report&groupcode=xx&hospcode=xxxxx&date=0000-00-00</td>
        </tr>
        <tr>
            <td>Auth Method</td>
            <td>Basic Auth</td>
        </tr>
        <tr>
            <td>Method</td>
            <td>GET</td>
        </tr>
        <tr>
            <td>Return</td>
            <td>JSON</td>
        </tr>
        <tr>
            <td>Parameter</td>
            <td>groupCode = 1<br>
                <span style="color:red">hospcode = xxxxx *request</span><br>
                <span style="color:red">date = 0000-00-00 *request</span>
            </td>
        </tr>
    </table>

    <per>
        <code>
            <strong>Request</strong>
            <p>Request Header:</p>
            Content-type: application/json<br>
            Authorization: Bearer [token]<br>
        </code>
    </per>
</div>
