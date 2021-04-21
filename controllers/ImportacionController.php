<?php

namespace app\controllers;

use Yii;
use app\models\Importacion;
use app\models\ImportacionSearch;
use app\models\Cliente;
use app\models\ClienteSearch;
use yii\web\Controller;
use app\models\UploadForm;
use app\models\Historial;
use app\models\ImportacionForm;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use ruskid\csvimporter\CSVImporter;
use ruskid\csvimporter\CSVReader;
use ruskid\csvimporter\MultipleImportStrategy;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

/**
 * ImportacionController implements the CRUD actions for Importacion model.
 */
class ImportacionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Importacion models.
     * @return mixed
     */
    public function actionIndex($message = null)
    {
        $searchModel = new ImportacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'message' => $message,
        ]);
    }

    /**
     * Displays a single Importacion model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Importacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Importacion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Importacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Importacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Importacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Importacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Importacion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionProcesar($token = null)
    {
        $model = new ImportacionForm();
        $importado = Importacion::find()->where(['token' => $token])->asArray()->all();
        $clientes = ArrayHelper::map(Cliente::find()->all(), 'id', 'nombre');

        $provider = new ArrayDataProvider([
            'allModels' => $importado,
            'pagination' => [
                'pageSize' => 5000,
            ],
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $token = Yii::$app->request->post('ImportacionForm')['token'];
            $id_cliente = Yii::$app->request->post('ImportacionForm')['cliente'];

            $cliente = Cliente::find()->where(['id' => $id_cliente])->one();
            $importado = Importacion::find()->where(['token' => $token])->andWhere(['importado' => 0])->all();

            if ($importado != null) {
                foreach ($importado as $i) {

                    $vars = array(
                        '{$observaciones}'  => '"' . $i['observaciones'] . '"',
                        '{$email}'          => '"' . $i['email'] . '"',
                        '{$nombre}'         => '"' . $i['nombre'] . '"',
                        '{$apellido}'       => '"' . $i['apellido'] . '"',
                        '{$telefono}'       => '"' . $i['telefono'] . '"',
                        '{$celular}'        => '"' . $i['celular'] . '"',
                        '{$direccion}'      => '"' . $i['direccion'] . '"',
                        '{$auto}'           => '"' . $i['auto'] . '"',
                        '{$vendor}'         => '"' . $i['vendor'] . '"',
                        '{$date}'           => '"' . date("Y-m-d\TH:i:s") . '.000000Z' . '"',
                    );

                    $curl = curl_init();

                    $urlsirena = "getsirena.com";
                    $urlpilot = "pilotsolution.com.ar";
                    $urltecnom = "tecnomcrm.com";
                    $urlsalesforce = "9201";

                    $headers = [];
                    
                    //En caso que estemos en un cliente de Tecnom. REQUIERE USR y PASS 
                    //Este if fue desarrollado por Deoliveira
                    //print_r('urltecnom: '.strpos($cliente['url'], $urltecnom).' ');
                    if ($cliente['user'] != '' && strpos($cliente['url'], $urltecnom)>=1) 
                    {
                        //print_r(' entro en urltecnom');
                        $headers = array
                        (
                            'Content-Type:application/json',
                            'Authorization: Basic ' . base64_encode($cliente['user'] . ":" . $cliente['password']), // <---
                        );
                    }

                    //En caso que estemos en un cliente de Sirena. Buscamos la parte constante de la pagina.
                    //agregado por Batista
                    //print_r('urlsirena: '.strpos($cliente['url'], $urlsirena).' ');
                    if(strpos($cliente['url'], $urlsirena)>=1) 
                    {
                        //print_r(' entro en urlsirena');
                        $headers = array
                        (
                            'Content-Type: application/json',
                            'cache-control: no-cache',
                        );
                    }
                    
                    //En caso que estemos en un cliente de Pilot.
                    //print_r('urlpilot: '.strpos($cliente['url'], $urlpilot).' ');
                    if(strpos($cliente['url'], $urlpilot)>=1)
                    {
                        //print_r(' entro en urlpilot');
                        $headers = array
                        (
                            'Content-Type: application/x-www-form-urlencoded',
                            'cache-control: no-cache',
                        );
                    }

                    //En caso que estemos en un cliente de Salesforce. REQUIERE USR y PASS 
                    //print_r('urlsalesforce: '.strpos($cliente['url'], $urlsalesforce).' ');
                    if ($cliente['user'] != '' && strpos($cliente['url'], $urlsalesforce)>=1) 
                    {
                        //print_r(' entro en urlsalesforce');
                        $headers = array
                        (
                            'Content-Type:application/json',
                            'Authorization: Basic ' . base64_encode($cliente['user'] . ":" . $cliente['password']), // <---
                            'dealer: YAC',
                        );
                    }
               
                    
                    //print_r('  '.implode(" ",$headers).' '.strtr($cliente['json'], $vars));
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $cliente['url'],
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => strtr($cliente['json'], $vars),
                        CURLOPT_HTTPHEADER  => $headers,
                    ));
                    
                    $response = curl_exec($curl);
                    $curl_err = curl_error($curl);
                    $curl_info = curl_getinfo($curl);
                    curl_close($curl);

                    $parse_response = json_decode($response, true);
                    $id = $this->parseaIdentificadorRespuesta($parse_response);
                    
                    //print_r('http_code: '.$curl_info['http_code']);
                    //print_r($err);
                    //print_r($response);
                    //print_r($parse_response);
                    //return $parse_response['success'];
                    
                    //Para el caso de Pilot  el error da success==falso y message=mensaje de error y data=mensaje de error
                    //Para el caso de Tecnom el error da summary==false y message=mensaje de error???
                    //Para el caso de Sirena el error da ???

					$response_success_aux_a = true;
                    if(isset($parse_response['success']) && isset($parse_response['message']))
                    {
                        if($parse_response['success'] == false)
                        {
							$response_success_aux_a = false;
						}
					}
					
					$response_success_aux_b = true;
                    if(isset($param_response['summary']) && isset($parse_response['message']))
                    {
                        if($parse_response['summary'] == 'Error')
                        {
							$response_success_aux_b = false;
						}				
					}
                    
                    $response_success_aux_c = true;
                    if(isset($curl_info['http_code']) && $curl_info['http_code']!=200)
                    {
                        $response_success_aux_c = false;
                    }

                    if ($curl_err || $response_success_aux_a == false || $response_success_aux_b == false || $response_success_aux_c == false) 
                    {
                        $error_ls = '';
                        
                        if ($curl_err) 
                        {
                            $error_ls .= $curl_err.' ';
                        }

                        if(isset($curl_info['http_code']) && $curl_info['http_code']!=200)
                        {
                            $error_ls .= $curl_info['http_code'].' ';
                        }

                        if (isset($parse_response['message'])) 
                        {
                            $error_ls .= $parse_response['message'].' ';
                            if(isset($parse_response['data']))
                            {
                                $error_ls .= $parse_response['data'].' ';
                            }
                        } 
                        else 
                        {
                            $error_ls .= $parse_response.' ';
                        }

                        return $this->redirect(array('importacion/index', 'message' => 'No han importado correctamente los registros. ' . $error_ls));
                    } 
                    else 
                    {
                        $i->fecha = date('Y-m-d H:i:s');
                        $i->id_asignado = $id;
                        $i->importado = 1;
                        $i->update(false);
                    }
                }

                $historial = new Historial();
                $historial->cliente_id = $id_cliente;
                $historial->cantidad = count($importado);
                $historial->fecha = date('Y-m-d H:i:s');
                $historial->save();

                return $this->redirect(array('importacion/index', 'message' => 'Se han importado correctamente ' . $historial->cantidad . ' registros.'));
            }
        }

        return $this->render('confirmar', ['model' => $model, 'token' => $token, 'provider' => $provider, 'clientes' => $clientes]);
    }

    private function parseaIdentificadorRespuesta($response)
    {
        $id = null;
        if (isset($response['id'])) {
            $id = $response['id'];
        }

        if (isset($response['data']['welcome_id'])) {
            $id = $response['data']['welcome_id'];
        }

        return $id;
    }

    /**
     * Lists all Cliente models.
     * @return mixed
     */
    public function actionAnalizar()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $token = substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyz0123456789', 10)), 0, 7);
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                //$csv = file_get_contents("uploads/".$model->imageFile->name);
                $importer = new CSVImporter;

                //Will read CSV file
                $importer->setData(new CSVReader([
                    'filename' => "uploads/" . $model->imageFile->name,
                    'fgetcsvOptions' => [
                        //'delimiter' => ''
                    ]
                ]));

                //Import multiple (Fast but not reliable). Will return number of inserted rows
                $numberRowsAffected = $importer->import(new MultipleImportStrategy([
                    'tableName' => Importacion::tableName(),
                    'configs' => [

                        [
                            'attribute' => 'vendor',
                            'value' => function ($line) {
                                return $line[0];
                            },
                        ],
                        [
                            'attribute' => 'nombre',
                            'value' => function ($line) {
                                return $line[1];
                            },
                            //'unique' => true, //Will filter and import unique values only. can by applied for 1+ attributes
                        ],
                        [
                            'attribute' => 'apellido',
                            'value' => function ($line) {
                                return $line[2];
                            },
                        ],
                        [
                            'attribute' => 'telefono',
                            'value' => function ($line) {
                                return $line[3];
                            },
                        ],
                        [
                            'attribute' => 'celular',
                            'value' => function ($line) {
                                return $line[4];
                            },
                        ],
                        [
                            'attribute' => 'direccion',
                            'value' => function ($line) {
                                return $line[5];
                            },
                        ],
                        [
                            'attribute' => 'email',
                            'value' => function ($line) {
                                return $line[6];
                            },
                        ],
                        [
                            'attribute' => 'auto',
                            'value' => function ($line) {
                                return $line[7];
                            },
                        ], [
                            'attribute' => 'observaciones',
                            'value' => function ($line) {
                                return $line[8];
                            },
                        ], [
                            'attribute' => 'token',
                            'value' => function ($line) use ($token) {
                                return $token;
                            },
                        ],
                        [
                            'attribute' => 'importado',
                            'value' => function ($line) {
                                return 0;
                            },
                        ]


                    ],
                ]));



                $this->redirect(array('importacion/procesar', 'token' => $token));
                //
            }
        }

        return $this->render('analizar', ['model' => $model]);
    }
}
