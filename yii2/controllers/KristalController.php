<?php

namespace app\controllers;

use app\models\Kristal;
use yii\data\ActiveDataProvider;
use yii\filters\auth\CompositeAuth;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\filters\auth\QueryParamAuth;

/**
 * ItemController implements the CRUD actions for Items model.
 */

/**
 * ItemController implements the CRUD actions for Items model.
 */
class KristalController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'authenticator' => [
                    'class' => CompositeAuth::class,
                    'authMethods' => [
                        QueryParamAuth::class
                    ]
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],

            ]
        );
    }

    /**
     * Lists all Order models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string[]
     */
    public function actionCreate()
    {
        $request = $this->request;

        // Controleren of het een POST-verzoek is
        if ($request->isPost) {
            $orderData = $request->post();
            
            $order = new Kristal();
            $order->order_item_id = $orderData['order_item_id'];
            $order->order_item_name = $orderData['order_item_name'];
            $order->order_item_type = $orderData['order_item_type'];
            $order->order_id = $orderData['order_id'];

            // Valideer en sla de order op
            if ($order->validate() && $order->save()) {
                // Order succesvol opgeslagen

                // Loop door de producten en voeg ze toe aan de order

                $this->response->format = Response::FORMAT_JSON;
                return ['status' => 'success', 'message' => 'Order is succesvol aangemaakt.'];
            } else {
                // Fout bij opslaan van de order
                $this->response->format = Response::FORMAT_JSON;
                return ['status' => 'error', 'message' => 'Fout bij het aanmaken van de order.'];
            }
        } else {
            // Ongeldig verzoeksmethode
            $this->response->format = Response::FORMAT_JSON;
            return ['status' => 'error', 'message' => 'Ongeldig verzoeksmethode. Alleen POST-verzoeken zijn toegestaan.'];
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
