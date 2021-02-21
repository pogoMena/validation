 <!-- StAuth10065: I Michael Mena, 000817498 certify that this material is my original work. No other person’s work has been used without due acknowledgement. I have not made my work available to anyone else.-->
 <!doctype html>
<html>
    <head>
    <style>
            #data{
                background-color: lightblue;
            }
            

            h1 {
                font-size: 40px;
                color: black;
            }

            p {
                font-size: 16px;
                color: darkgray;
            }

            @media only screen and (max-width: 320px) {
                h1 {
                    font-size: 60px;
                    color: red;
                }

                p {
                    font-size: 22px;
                    color: black;
                }
            }

            @media only screen and (max-width: 768px) {
                h1 {
                    font-size: 60px;
                    color: black;
                }

                p {
                    font-size: 22px;
                    color: black;
                }
            }

            #employeeGrid{
                margin-right: 15%;
            }
        </style>
        <title>Lab 2 – CSS Frameworks</title>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script>
            var lastID = 0;
            function changed(fieldName) {
                var fieldValue = $(`#${fieldName}`).val();
                
                var data = {
                    field: fieldName,
                    value: fieldValue
                };

            
                $.ajax({
                url: "validate.php",
                type: "POST",
                data: data,
                cache: false,
                success: function (res) {
                    
                    if(res.error === false) {
                            $(`#${res.field}`).removeClass('is-invalid');
                            $(`#${res.field}`).addClass('is-valid');
                            $(`#${res.field}`).parent().find('.invalid-feedback').text('');
                            
                        } else {
                            
                            $(`#${res.field}`).addClass('is-invalid');
                            $(`#${res.field}`).removeClass('is-valid');
                            switch(res.error) {
                                case "ERROR_NON_ALPHA": 
                                    $(`#${res.field}`).parent().find('div.invalid-feedback').text(`must not have the numbers`);
                                    break;
                                case "nameERROR_NON_ALPHA":
                                    $(`#${res.field}`).parent().find('div.invalid-feedback').text(`Employee name cannot contain digits`);
                                    break;
                                case "nameERROR_LENGTH":
                                    $(`#${res.field}`).parent().find('.invalid-feedback').text(`Employee name must be between 5-20 characters in length.`);
                                    break;
                                case "ERROR_LENGTH":
                                    $(`#${res.field}`).parent().find('.invalid-feedback').text(`must be a certain length`);
                                    break;
                                case "idERROR_LENGTH":
                                    $(`#${res.field}`).parent().find('.invalid-feedback').text(`Employee ID must be 9 digits in length.`);
                                    break;
                                case "idERROR_NON_INT":
                                    $(`#${res.field}`).parent().find('.invalid-feedback').text(`Employee ID must only contain digits.`);
                                    break;
                                case "Advertising":
                                    $(`#${res.field}`).parent().find('.invalid-feedback').text(`Advertising is not a valid department.`);
                                    break;
                                case "bonusERROR_LENGTH":
                                    $(`#${res.field}`).parent().find('.invalid-feedback').text(`Please enter a numerical value.`);
                                    break;
                                case "bonusERROR_NON_INT":
                                    $(`#${res.field}`).parent().find('.invalid-feedback').text(`Bonus must only contain digits.`);
                                    break;
                                default:
                                    $(`#${res.field}`).parent().find('.invalid-feedback').text(`some other error.`);
                                    break;
                            }
                        }
        
                    }
                });
                
            }


            //Handles the "submit" button and adds row to table with correlating values
            function submitClick(){
                changed('employee_name');
                changed('employee_id');
                changed('department');
                changed('bonus');

                //Makes the table visible once a valid entry is submitted
                if($('#employee_name').hasClass('form-control is-valid') && $('#employee_id').hasClass('form-control is-valid') && $('#department').hasClass('form-control is-valid') && $('#bonus').hasClass('form-control is-valid')){
                    $(`#employeeGrid`).removeClass('d-none');
                    $(`#employeeGrid`).addClass('d-block');
                    //Adds row to table
                if($("#employee_id").val() != lastID){
                    lastID = $("#employee_id").val();
                    var tableBody = $("table tbody");
                    var empName = $("#employee_name").val();
                    var empID = $("#employee_id").val();
                    var department = $("#department").val();
                    var bonus = $("#bonus").val();
                    
                    var info = "<tr class='d-flex' id='data' ><td class='col-4'>" + empName + "</td><td class='col-3'>"+ empID +"</td><td class='col-3'>"+ department +"</td><td class='col-2'> $"+ bonus +".00</td></tr>";
                    tableBody.append(info);
                }
            }
                

            };
            


            

            

        </script>
    </head>

    <body class="m-5">
    
        <div class="ml-5 mb-5"><h1>Employee Registry</h1></div>
        <form class="needs-validation">
            <div class="form-row mb-3" id="nameDiv">
                <div class="col-2"></div>
                <div class="col-1  mr-5">Name</div>

                <div class="col-7"><input  class="form-control" type="text" id="employee_name" name="employee_name" aria-describedby="inputGroupPrepend" onkeyup="changed('employee_name')" value="" placeholder="Jane Doe">
                <div class="invalid-feedback">Thats not quite right</div>
            </div>
                
                
            </div>
            <div class="form-row mb-3" id="idDiv">
                <div class="col-2"></div>
                <div class="col-1  mr-5">Employee ID</div>
                <div class="col-7"><input class="form-control"  type="number" id="employee_id" name="employee_id" onkeyup="changed('employee_id')" value="" placeholder="429126346"><div class="invalid-feedback">nopers not today</div></div>
                
            </div>
            <div class="form-row mb-3" id="departmentDiv">
                <div class="col-2"></div>
                <div class="col-1  mr-5">Department</div>
                <div class="col-7"><input type="text" class="form-control"  id="department" name="department" onkeyup="changed('department')" value="" placeholder="Sales"><div class="invalid-feedback"></div></div>
                
            </div>
            <div class="form-row mb-3" id="bonusDiv">
                <div class="col-2"></div>
                <div class="col-1  mr-5">Bonus</div>
                <div class="col-7"><input type="number" class="form-control"  id="bonus" name="bonus" onkeyup="changed('bonus')" value="" placeholder="250000"><div class="invalid-feedback"></div></div>
                
           </div>
            <div class="form-row mb-3">
                <div class="col-2"></div>
                <div class="col-1  mr-5"><input class="btn btn-primary" type="button" onclick="submitClick()" value="Submit form" id="submitButton"></div>
                
            </div>
        </form>

        <div class="d-none" id="employeeGrid">
        <table class="table table-bordered mx-5" >
            <thead>
                <tr class="d-flex">
                    <th class="col-4">Employee Name</th>
                    <th class="col-3">Employee ID</th>
                    <th class="col-3">Department</th>
                    <th class="col-2">Bonus</th>
                </tr>
            </thead>
            <tbody id="information">
                
                </tbody>
        </table>
        </div>

    </body>
</html>