<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <script src="../../../Bootstrap/js/jquery-1.12.4.js"></script>
    <script src="../../../Bootstrap/js/jquery.dataTables.min.js"></script>
    <script src="../../../Bootstrap/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../Bootstrap/css/bootstrap-theme.min.css">
    <script src="../../../Bootstrap/js/bootstrap.min.js"></script>
    <style>
        body{
            background-color: #d0d5dd;
        }

        .wrapper{
            width: 70%;
            margin: auto;
            min-width: 400px;
            box-shadow: 0px 0px 30px #888888;
        }

        .header{
            height:75px;
            width:100%;
            text-align: center;
            margin-top: auto;
            padding-bottom: 20px;

            border-bottom: solid;
            border-bottom-color: #c9ddff;
            background-color: #f4f8ff;
        }

        .page{
            min-height: calc(100% - 75px);
            width:100%;
            background-color: white;
            text-align: left;
        }

        .menutext{
            width: 100%;
            padding: 10px 10px 10px 10px;
            background-color: #f4f8ff;
        }

        .menupoint{
            width: 100%;
            padding: 10px 10px 10px 10px;
        }
        .menupoint:hover {
            animation-name: menupunktanimation;
            animation-duration: 0.5s;
            background-color: #c9ddff;
        }
        @keyframes menupunktanimation{
            from {background-color: #eaf2ff;}
            to {background-color: #c9ddff;}
        }

        .nopadding{
            padding-bottom: 0px;
            padding-top: 0px;
            padding-right: 0px;
            padding-left: 0px;
        }

        .content{
            padding-bottom: 10px;
            padding-top: 10px;
            padding-right: 10px;
            padding-left    : 10px;

            overflow-y: scroll;
            height: calc(100% - 75px);
        }
        @media screen and (min-width: 768px) {
            .menu {
                height: calc(100% - 75px);
                border-right: solid;
                border-right-color: #c9ddff;
            }
        }

        .menu{

            border-bottom: solid;
            border-bottom-color: #c9ddff;
            background-color: #f4f8ff;
        }

        .row {
            margin-left: 0px;
            margin-right: 0px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header row">
        <h1 style="margin-top: 15px;">TanteEmmaLaden</h1>
    </div>
    <div class="page row">