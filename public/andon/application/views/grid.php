<table class="table table-bordered">
    <thead>
    <tr>
        <th></th>
        <?php
            if(count($g_data) > 0 ) {
                foreach ($g_data[0]['times'] as $time){
                    echo '<th style="text-align: center;">'.date('d/m',strtotime($time['time'])).'<br/>'.date('H:i',strtotime($time['time'])).'</th>';
                }
            }
        ?>
    </tr>
    </thead>
    <tbody>
    <?php
    if(count($g_data) > 0 ) {
        foreach ($g_data as $data){
            echo '<tr>';
            echo '<td style="text-align: center;">'.$data['andon'].'</td>';
            foreach ($data['times'] as $time){
                echo '<td>';
                if($time['red_andon'] > 0 && $time['yellow_andon'] > 0) {
                    echo "<div style='width:40%; background-color: red; height: 100%; float: left;'>&nbsp;</div>";
                    echo "<div style='width:40%; background-color: yellow; height: 100%; float: right;'>&nbsp;</div>";
                } else {
                    if($time['red_andon'] > 0) {
                        echo "<div style='width:40%; background-color: red; height: 100%; margin: 0 auto;'>&nbsp;</div>";
                    }
                    if($time['yellow_andon'] > 0) {
                        echo "<div style='width:40%; background-color: yellow; height: 100%; margin: 0 auto;'>&nbsp;</div>";
                    }
                }
                echo '</td>';
            }
            echo '</tr>';
        }
    }
    ?>
    </tbody>
</table>