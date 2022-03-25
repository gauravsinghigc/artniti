<?php

//Update function
function UPDATE($SQL, $die = false)
{
    global $DBConnection;
    $Update = "$SQL";

    //die entry
    if ($die == true) {
        die($Update);
    }
    $Query = mysqli_query($DBConnection, $Update);
    if ($Query == true) {
        return true;
    } else {
        return false;
    }
}

//delete
function DELETE($SQL, $die = false)
{
    global $DBConnection;
    $Update = "$SQL";

    //die entry
    if ($die == true) {
        die($Update);
    }
    $Query = mysqli_query($DBConnection, $Update);
    if ($Query == true) {
        return true;
    } else {
        return false;
    }
}

//Check function
function CHECK($SQL, $die = false)
{
    global $DBConnection;
    $Check = "$SQL";

    //die entry
    if ($die == true) {
        die($Check);
    }
    $Query = mysqli_query($DBConnection, $Check);
    $Count = mysqli_num_rows($Query);
    if ($Count == 0 or $Count == null) {
        return false;
    } else {
        return true;
    }
}


//Insert Data
function SAVE($tablename, array $INSERT, $die = false)
{
    global $DBConnection;
    $tablename = $tablename;
    $Datatables = "";
    $TableValues = "";
    $tablerows = $INSERT;
    $arraycount = count($tablerows);
    $mainarray = $arraycount - 1;

    foreach ($tablerows as $key => $value) {
        global $$value;
    }


    foreach ($tablerows as $key => $value) {
        if ($key == $mainarray) {
            $TableValues .= "'" . htmlentities($$value) . "'";
        } else {
            $TableValues .= "'" . htmlentities($$value) . "', ";
        }
    }

    foreach ($tablerows as $key => $value) {
        if ($key == $mainarray) {
            $Datatables .= "$value";
        } else {
            $Datatables .= "$value, ";
        }
    }
    $InsertNewData = "INSERT INTO $tablename ($Datatables) VALUES ($TableValues)";

    //die entry
    if ($die == true) {
        die($InsertNewData);
    }
    $Query = mysqli_query($DBConnection, $InsertNewData);
    if ($Query == true) {
        return true;
    } else {
        return false;
    }
}

//Select Data
function SELECT($SQL, $die = false)
{
    global $DBConnection;
    $SELECT = "$SQL";

    if ($die == true) {
        die($SELECT);
    }

    $QUERY = mysqli_query($DBConnection, $SELECT);
    if ($QUERY == true) {
        return $QUERY;
    } else {
        return false;
    }
}

//Count Data
function TOTAL($SQL)
{
    global $DBConnection;
    $SQL = "$SQL";
    $Query = mysqli_query($DBConnection, $SQL);
    $Count = mysqli_num_rows($Query);
    if ($Count == 0) {
        return "0";
    } else {
        return $Count;
    }
}

//configuration
function CONFIG($Data, $die = false)
{
    global $DBConnection;
    $SELECT_configurations = "SELECT * FROM configurations where configurationname='$Data'";

    //die entry
    if ($die == true) {
        die($SELECT_configurations);
    }
    $QUERY_configurations = mysqli_query($DBConnection, $SELECT_configurations);
    $Configurations = mysqli_fetch_array($QUERY_configurations);
    $IsConfigurationFetched = mysqli_num_rows($QUERY_configurations);
    if ($IsConfigurationFetched == 0) {
        $Value = "null";
    } else {
        $Value = $Configurations['configurationvalue'];
    }

    return $Value;
}

//configuration
function CONFIG_FIELDS($Data, $VALUE, $die = false)
{
    global $DBConnection;
    $SELECT_configurations = "SELECT * FROM configurations where configurationname='$Data'";

    //die entry
    if ($die == true) {
        die($SELECT_configurations);
    }

    $QUERY_configurations = mysqli_query($DBConnection, $SELECT_configurations);
    $Configurations = mysqli_fetch_array($QUERY_configurations);
    $IsConfigurationFetched = mysqli_num_rows($QUERY_configurations);
    if ($IsConfigurationFetched == 0) {
        $Value = "null";
    } else {
        $Value = $Configurations["$VALUE"];
    }

    return $Value;
}

//amount total
function AMOUNT($SQL, $T)
{
    global $DBConnection;
    $TotalAmountPaid = SELECT("$SQL");
    $TotalAmount = 0;
    while ($fetchtotalpayment = mysqli_fetch_array($TotalAmountPaid)) {
        $TotalAmount += $fetchtotalpayment["$T"];
    }
    if ($TotalAmount == 0 or $TotalAmount == null) {
        $TotalAmount = 0;
    } else {
        $TotalAmount = $TotalAmount;
    }
    return $TotalAmount;
}


//Suggestion List
function SUGGEST($table = "false", $column, $order)
{
    if ($table != "false") {
        $CHECK_project_tags = CHECK("SELECT * FROM $table");
        if ($CHECK_project_tags != 0) {
            echo "<datalist id='$column'>";
            $SQL_project_tags = SELECT("SELECT * FROM $table GROUP by $column ORDER BY $column $order");
            while ($FetchTags = mysqli_fetch_array($SQL_project_tags)) { ?>
                <option value='<?php echo $FetchTags["$column"]; ?>'></option>
    <?php }
            echo "</datalist>";
        }
    } else {
    }
}


//fetch values 
function FETCH($SQL, $data)
{
    $Query = SELECT($SQL);
    $FetchDATA = mysqli_fetch_array($Query);
    $ReturnData = $FetchDATA["$data"];
    if ($FetchDATA == null) {
        $results = null;
    } elseif ($FetchDATA == false) {
        $results = "Data not available";
    } else if ($FetchDATA == true) {
        $results = $ReturnData;
    } else {
        $results = null;
    }
    return $results;
}

//fetch data 
function FETCH_DATA($SQL)
{
    $Query = SELECT($SQL);
    $FetchDATA = mysqli_fetch_array($Query);
    if ($FetchDATA == null) {
        $results = null;
    } else {
        $results = $FetchDATA;
    }

    return $results;
}

//fetch all in array / json formate
function FetchConvertIntoArray($sql, $array = false)
{
    $Data = SELECT("$sql");
    $Count = CHECK("$sql");
    if ($Count == 0) {
        return null;
    } else {
        while ($FetchAllData = mysqli_fetch_array($Data)) {
            $FetchedColumns[] = $FetchAllData;
        }

        if ($array == true) {
            return json_decode(json_encode($FetchedColumns));
        } else {
            return json_encode($FetchedColumns);
        }
    }
}


//get data at details
function GET_DATA($data)
{
    global $PageSqls;

    $results = FETCH($PageSqls, $data);
    if ($results == null or $results == "" or $results == " ") {
        $results = null;
    } else {
        $results = $results;
    }

    if ($results == null) {
        return null;
    } else {
        return $results;
    }
}


//upate table 
function UPDATE_TABLE($sqltables, array $colums, $conditions, $die = false)
{
    $AvalableArrays = count($colums) - 1;
    $Columns = "";
    foreach ($colums as $key => $value) {
        global $$value;
        if ($AvalableArrays == $key) {
            $Columns .= $value . "='" . $$value . "'";
        } else {
            $Columns .= $value . "='" . $$value . "',";
        }
    }

    $Update = UPDATE("UPDATE $sqltables SET $Columns where $conditions");

    //die entry
    if ($die == true) {
        UPDATE("UPDATE $sqltables SET $Columns where $conditions", true);
    }

    if ($Update == true) {
        return true;
    } else {
        return false;
    }
}

//delete 
function DELETE_FROM($table, $conditions, $die = false)
{

    //die entry
    if ($die == true) {
        $Delete = DELETE("DELETE FROM $table WHERE $conditions", true);
    } else {
        $Delete = DELETE("DELETE FROM $table WHERE $conditions");
    }

    //die entry 
    if ($die == true) {
        die($Delete);
    }

    if ($Delete == true) {
        return true;
    } else {
        return false;
    }
}


//delete function 
function DELETE_BUTTON($controller, $delete_action, $return_url, $control_id)
{
    ?>
    <a href="<?php echo DOMAIN; ?>/controller/<?php echo $controller; ?>.php?<?php echo $delete_action; ?>=<?php echo SECURE('true', 'e'); ?>&access_url=<?php echo SECURE($return_url, "e"); ?>&control_id=<?php echo SECURE($control_id, "e"); ?>" class="btn-danger btn-sm btn"><i class="fa fa-trash"></i> Delete</a>
<?php
}
