<?php

namespace App\Controllers;

use App\Models\Inventario;
use CodeIgniter\Format\Exceptions\FormatException;
use CodeIgniter\Database\Exceptions\DataException;

class InventarioController extends BaseController
{
    

    public function stock()
    {
        $json = $this->request->getJSON();
       // echo json_encode($json->message);die();
        $inventario = new Inventario();
        $data = $inventario
        ->select('(select quantity from inventario where codigo = '.$json->message.' limit 1) as quantity, inventario.*')
        ->where(['codigo' => $json->message])
        ->asObject()
        ->first();


        if(is_null($data)) {
            echo json_encode([
                'next_patterns' => "",
                'options' => [
                    'Ver Stock',
                    'Crear producto'
                ],
                'type'  => "Buttons",
                'message' => 'El codigo del producto no existe'
            ]);die();
        }
        echo json_encode([
            'next_patterns' => "",
            'options' => [
                'Ver Stock',
                'Crear producto'
            ],
            'type'  => "Buttons",
            'message' => '
            Información
            <table><tbody><tr><td>Producto:</td><td class="left">'.$data->name.'</td></tr><tr><td>Codigo:</td><td class="left">'.$data->codigo.'</td></tr><tr><td>Stock:</td><td class="left">'.$data->quantity.'</td></tr><tr><td>V. unidad:</td><td class="left">'. number_format($data->precio, '2', ',', '.').'</td></tr></tbody></table>'
        ]);die();
    }

    public function register()
    {

        $json = $this->request->getJSON();
        file_put_contents('prueba.txt',  PHP_EOL.$json->message,  FILE_APPEND | LOCK_EX);

        
    
        $data = [];
        if(count(file("prueba.txt")) == 5) {
            $fichero = fopen('prueba.txt', "r");
            while (!feof($fichero)){ 
                array_push($data, fgets($fichero));     
            } 
            fclose($fichero); 
            try{
                $inventario = new Inventario();
                $inventario->save([
                    'codigo'    => trim($data[1]),
                    'name'      => $data[2],
                    'quantity'  => $data[3],
                    'precio'    => $data[4]
                ]);
                unlink('prueba.txt');
                echo json_encode([
                    'options' => [
                        'Ver Stock',
                        'Crear producto'
                    ],
                    'type'          => "Buttons",
                    'next_patterns' => "",
                    'message'       => '
                        El producto fue registrada correctamente.
                        <table>
                        <tbody>
                            <tr>
                                <td>Producto:</td>
                                <td class="left">'.$data[2].'</td>
                            </tr>
                            <tr>
                                <td>Codigo:</td>
                                <td class="left">'.$data[1].'</td> 
                            </tr>
                            <tr>
                                <td>Stock:</td>
                                <td class="left">'.$data[3].'</td>
                            </tr>
                            <tr>
                                <td>V. unidad: </td>
                                <td class="left">'. number_format($data[4], '2', ',', '.').'</td>
                            </tr>
                            </tbody>
                        </table>'
                ]);die();
            }catch(\Exception $e) {
              
                echo json_encode([
                    'options' => [
                        'Ver Stock',
                        'Crear producto'
                    ],
                    'type'          => "Buttons",
                    'next_patterns' => "",
                    'message'       => 'El producto no pudo ser guardado intentalo de nuevo' 
                ]);die();
            }catch(FormatException $e2) {
           
                echo json_encode([
                    'options' => [
                        'Ver Stock',
                        'Crear producto'
                    ],
                    'type'          => "Buttons",
                    'next_patterns' => "",
                    'message'       => 'El producto no pudo ser guardado intentalo de nuevo' 
                ]);die();
            }catch(DataException $e3) {
                
                echo json_encode([
                    'options' => [
                        'Ver Stock',
                        'Crear producto'
                    ],
                    'type'          => "Buttons",
                    'next_patterns' => "",
                    'message'       => 'El producto no pudo ser guardado intentalo de nuevo' 
                ]);die();
            }
            
            
           
         
           
        }

        if(count(file("prueba.txt")) == 2) {
            echo json_encode([
                'options'       => [],
                'type'          => "input",
                'message'       => 'Por favor ingresar un el nombre de producto',
                'next_patterns' => "crear cantidad"
            ]);die();
        }else if(count(file("prueba.txt")) == 3) {
            echo json_encode([
                'options'       => [],
                'type'          => "input",
                'message'       => 'Por favor ingresar la cantidad del producto',
                'next_patterns' => "crear precio"
            ]);die();

        }else if(count(file("prueba.txt")) == 4) {
            echo json_encode([
                'options'       => [],
                'type'          => "input",
                'message'       => 'Por favor ingresar el valor del producto',
                'next_patterns' => "guardar datos"
            ]);die();
        }
      
        
        
   
      /*  echo json_encode([
            'options' => [
                'Ver Stock',
                'Crear producto'
            ],
            'type'  => "Buttons",
            'message' => 'El producto: '.$data->name.' con codigo: '.$data->codigo.' tiene en stock: '.$data->quantity.' por un valor por unidad de: '. number_format($data->precio, '2', ',', '.') 
        ]);die();*/

    }

    public function index() 
    {
        $inventario = new Inventario();
        $inventarios = $inventario->asObject()->orderBy('id', 'desc');

        return view('inventario/index',[
            'inventarios'   => $inventarios->paginate(10),
            'pager'         => $inventarios->pager,
        ]);
    }
}
