<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/21/15
 */

class ProfileController extends Controller
{
    public function actionIndex()
    {

        $this->render('index');
    }

    public function actionDashboard()
    {

        $this->render('dashboard');
    }
}