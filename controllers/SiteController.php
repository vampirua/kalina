<?php

namespace app\controllers;

use app\common\RegistrationForm;
use app\models\Catalog;
use app\modules\product\models\Product;
use app\modules\user\models\User;
use app\modules\variant\models\Variant;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    public function actionSingup()
    {
        if (!Yii::$app->user->isGuest) {

            return $this->goHome();
        }

        $model = new RegistrationForm();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {

            $user = new User();

            $user->username = $model->username;
            $user->auth_key = $model->password;
            $user->status = 1;
            $user->email = $model->email;
            $user->phone = $model->phone;
            $user->created_at = date('l jS \of F Y h:i:s A');
            $user->updated_at = date('l jS \of F Y h:i:s A');
            $user->password_hash = \Yii::$app->security->generatePasswordHash($model->password);
            $user->save();
            $this->redirect('index');

        }
        return $this->render('singup', compact('model'));

    }


    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionCart()
    {
        $model = Yii::$app->cart->getPositions();

        return $this->render('cart', ['model' => $model]);
    }

    public function actionCheckout()
    {
        return $this->render('checkout');
    }

    public function actionCatalog()
    {

        $searchModel = new Catalog();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('catalog', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionSave()
    {
        $id = Yii::$app->request->get('id');

        $cart = Yii::$app->cart;
        $model = Variant::find()->where(['id' => $id])->with('product')->one();
        if ($model) {
            $cart->put($model, 1);
            return $this->redirect(['site/cart']);
        }
        throw new NotFoundHttpException();
    }

    public function actionDelete($id)
    {
        $model = Yii::$app->cart->getPositionById($id);

        Yii::$app->cart->remove($model);
        if (Yii::$app->cart->getIsEmpty()) {
            return $this->redirect('index');

        }else{
            return $this->redirect('/site/cart');
        }


    }

    public function actionSingle()
    {
        $id = Yii::$app->request->get('id');
        $model = Product::find()->where(['id' => $id])->with('variants', 'variants.color', 'vendor')->one();

        return $this->render('shop-single', ['model' => $model]);
    }

    public function actionThankyou()
    {
        return $this->render('thankyou');
    }
}
