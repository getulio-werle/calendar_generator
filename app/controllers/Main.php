<?php

namespace calendar_generator\Controllers;

class Main extends BaseController
{
    public function index()
    {
        return $this->view('index');
    }

    public function make_calendar()
    {
        // data validation
        // check if month as empty
        if (empty($_POST['month'])) {
            return header('Location: index.php');
        }
        // get data from form
        $pos = strpos($_POST['month'], '-');
        // the first part is the year
        $year = substr($_POST['month'], 0, $pos);
        // the second part is the month
        $month = substr($_POST['month'], $pos + 1);
        // check if value of month and year is numeric 
        if (!is_numeric($year) || !is_numeric($month)) {
            return header('Location: index.php');
        }
        // check if month is valid
        if ($month < 01 || $month > 12) {
            return header('Location: index.php');
        }
        
        // construct calendar
        $calendar = construct_calendar($month, $year);

        // calendar is finished... 
        // gen and show pdf
        return gen_pdf($calendar);
    }
}

?>