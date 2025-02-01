<?php

function construct_calendar($month, $year)
{
    // construct calendar
    // month and year on top
    $calendar = "<h1>" . MONTHS[$month - 1] . " de " . $year . "</h1>";
    // init table with days of the week
    $calendar .= "<table border='1'>
                        <thead>
                            <tr>";
    foreach (DAYS_OF_WEEK as $day) {
        $calendar .= "<th>$day</th>";
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
        // check if has events for the day
        $events_names = [];
        if (in_array($i, $_POST)) {
            $events_of_day_keys = array_keys($_POST, $i);
            $event_number = 1;
            foreach ($events_of_day_keys as $event_key) {
                $event_day_array = explode('_', $event_key);
                $num = $event_day_array[count($event_day_array) - 1];
                $events_names[$event_number] = $_POST["new_event_name_$num"];
                // verify if string > 7, if yes, break the line
                // to fit in the cell
                if (strlen($events_names[$event_number]) > 7) {
                    $number_of_break_rows = intdiv(strlen($events_names[$event_number]), 7);
                    for ($j = 1; $j <= $number_of_break_rows; $j++) {
                        if ($j == 1) {
                            $events_names[$event_number] = substr_replace($events_names[$event_number], '<br>', 7, 0); // on first pass
                        } else {
                            $events_names[$event_number] = substr_replace($events_names[$event_number], '<br>', (7 * $j) + 4, 0); // +4 because '<br>'
                        }
                    }
                }
                $event_number += 1;
            }
        }
        // check if day is sunday or saturday
        switch (date('w', strtotime("$year-$month-$i"))) {
            case 0:
                $calendar .= "<td class='sunday'>$i<br>";
                foreach ($events_names as $event_name) {
                    $calendar .= $event_name . "<br>";
                }
                $calendar .= "</td>";
                break;
            case 6:
                $calendar .= "<td class='saturday'>$i<br>";
                foreach ($events_names as $event_name) {
                    $calendar .= $event_name . "<br>";
                }
                $calendar .= "</td>";
                break;
            default:
                $calendar .= "<td class='other_days'>$i<br>";
                foreach ($events_names as $event_name) {
                    $calendar .= $event_name . "<br>";
                }
                $calendar .= "</td>";
                break;
        }
        $cell_count += 1;
    }
    // close the document
    $calendar .= "  </tbody>
                    </table>";

    return $calendar;
}

function gen_pdf($calendar)
{
    // gen pdf
    $stylesheet = file_get_contents('assets/css/calendar_style.css');
    $html = $calendar;
    $mpdf = new \Mpdf\Mpdf([
        'default_font_size' => CALENDAR_FONT_SIZE,
        'default_font' => CALENDAR_FONT_FAMILY
    ]);
    $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
    // output
    return $mpdf->Output();
}
