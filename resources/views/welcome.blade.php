<!DOCTYPE html>
<html lang="en">

<head>
    @include('head/head_top')
    <title>{{ 'Travel Allowance Overview - Tenzinger 6G' }}</title>
    @include('head/head_bottom')
</head>

<body>
    <section class="table">

        <div class="container">

            <h1 class="title">
                Travel Allowance Overview - Tenzinger 6G
            </h1>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Employee</th>
                        <th scope="col">Vehicle</th>
                        <th scope="col">Distance / Day<br> (km, Both Ways)</th>
                        <th scope="col">Workdays<br> / Week</th>
                        <th scope="col">Compensation<br> / Month</th>
                        <th scope="col">First Monday<br>/ Month</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $employeeArray = []; ?>
                    @for ($a = 0; $a < count($employees); $a++)
                        <?php
                        
                        switch ($employees[$a]->vehicle_type) {
                            case 'car':
                                $compensation = $employees[$a]->distance * 2 * 0.1;
                                break;
                            case 'bus':
                                $compensation = $employees[$a]->distance * 2 * 0.25;
                                break;
                            case 'bike':
                                if ($employees[$a]->distance >= 5) {
                                    $compensation = $employees[$a]->distance * 2 * 2 * 0.5;
                                    break;
                                }
                                $compensation = $employees[$a]->distance * 2 * 0.5;
                                break;
                            case 'train':
                                $compensation = $employees[$a]->distance * 2 * 0.25;
                                break;
                        }
                        
                        //Get the first day of next month
                        $first_monday = date('d-M-Y', strtotime('first monday of next month'));
                        //Result could be: Monday, 07-Mar-2022
                        
                        array_push($employeeArray, " " . $employees[$a]->name);
                        array_push($employeeArray, " " . $employees[$a]->vehicle_type);
                        array_push($employeeArray, " " . $employees[$a]->distance * 2 . 'km');
                        array_push($employeeArray, " " . $employees[$a]->workdays . " workdays per week");
                        array_push($employeeArray, " " . '€ ' . number_format(((($compensation * 
                        ceil($employees[$a]->workdays)) / 7) * 365) / 12, 2));
                        array_push($employeeArray, " " . $first_monday);
                        ?>
                        <tr>
                            <th scope="row"><?php print_r($employees[$a]->name); ?></th>
                            <td><?php print_r($employees[$a]->vehicle_type); ?></td>
                            <td><?php print_r($employees[$a]->distance * 2) . 'km'; ?></td>
                            <td><?php print_r($employees[$a]->workdays); ?></td>
                            <td><?php print_r('€ ' . number_format(((($compensation * 
                            ceil($employees[$a]->workdays)) / 7) * 365) / 12, 2)); ?></td>
                            <td><?php echo $first_monday; ?></td>
                        </tr>
                    @endfor
                    <?php
                    
                    echo '<p hidden>';
                    $str = print_r($employeeArray);
                    
                    print_r(array_chunk($employeeArray, count($employeeArray)));
                    $employeeArray = array_values($employeeArray);
                    
                    $employee_csv_string = '';
                    $c = 1;
                    for ($b = 0; $b < count($employeeArray); $b++) {
                        if ($c % 6 == 0) {
                            $employee_csv_string .= $employeeArray[$b] . '\\n';
                        } else {
                            $employee_csv_string .= $employeeArray[$b] . ',';
                        }
                        $c++;
                    }
                    echo '</p>';
                    
                    ?>
                </tbody>
            </table>

            <button type="button" class="btn btn-light" onclick="saveData(data, fileName)">Export CSV</button>

            <script defer>
                const saveData = (function() {
                    const a = document.createElement("a");
                    document.body.appendChild(a);
                    a.style = "display: none";
                    return function(data, fileName) {
                        const blob = new Blob([data], {
                                type: "octet/stream"
                            }),
                            url = window.URL.createObjectURL(blob);
                        a.href = url;
                        a.download = fileName;
                        a.click();
                        window.URL.revokeObjectURL(url);
                    };
                }());

                var csvString = "<?= $employee_csv_string ?>";
                const data = csvString,
                    fileName = "TravelCompensation-Tenzinger-6G.csv";
            </script>

        </div>

    </section>

</body>

</html>
