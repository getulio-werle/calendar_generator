<?php

namespace calendar_generator\Controllers;

class Main extends BaseController
{
    public function index()
    {
        $this->view('index');
    }

    public function make_calendar()
    {
        // check if month as empty
        if (empty($_POST['month'])) {
            header('Location: index.php');
        }
        // get data from form
        $pos = strpos($_POST['month'], '-');
        // the first part is the year
        $year = substr($_POST['month'], 0, $pos);
        // the second part is the month
        $month = substr($_POST['month'], $pos + 1);
        // check if value of month and year is numeric 
        if (!is_numeric($year) || !is_numeric($month)) {
            header('Location: index.php');
        }
        if ($month < 01 || $month > 12) {
            header('Location: index.php');
        }
        // construct calendar
        $months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
        $calendar = "<h1>" . $months[$month - 1] . " de " . $year . "</h1>";
        $days_of_the_week = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'];
        // init table with days of the week
        $calendar .= "<table border='1'>
                        <thead>
                            <tr>";
        foreach ($days_of_the_week as $day) {
            $calendar .= "<th style='width: 14%;'>$day</th>";
        }
        $calendar .=        "</tr>
                        </thead>
                        <tbody>
                            <tr>";
        $cell_count = 0;
        // get day of the week of first day of the month
        $first_day = date('w', strtotime("$year-$month-01"));
        // fill in the blanks by the first day of the month
        for ($i = 0; $i < $first_day; $i++) {
            $calendar .= "<td style='border: none;'></td>";
            $cell_count += 1;
        }
        // fill rest of days
        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for ($i = 1; $i <= $days_in_month; $i++) {
            // check if the day is Saturday to break the line
            if ($cell_count % 7 ==  0) {
                $calendar .= "</tr>";
                if ($cell_count < 42) {
                    $calendar .= "<tr>";
                }
            }
            $calendar .= "<td>$i</td>";
            $cell_count += 1;
        }
        // close the document
        $calendar .= "  </tbody>
                    </table>";

        // gen and show pdf
        $stylesheet = file_get_contents('assets/css/calendar_style.css');
        $html = $calendar;
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 12,
            'default_font' => 'dejavusans'
        ]);
        $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
        $mpdf->Output();
    }
}
