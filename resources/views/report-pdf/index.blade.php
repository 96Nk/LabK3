<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{$title}}</title>
    <style type="text/css">
        body {
            font-family: Tahoma, Verdana, Segoe, sans-serif;
            font-size: 12pt
        }

        p {
            font-size: 11pt;
            text-align: justify;
        }

        #wrapper {
            max-width: 1200px;
            min-width: 1200px;
            margin: 0 auto;
            margin-bottom: 30px;
            margin-top: 20px;
        }

        @media print {
            input.noPrint {
                display: none;
            }
        }

        #wrapper2 {
            border: 1px solid;
            padding: 10px;
        }

        td {
            padding: 3px 5px 3px 5px;
            font-size: 12pt;
            vertical-align: top;
        }

        th {
            padding: 8px;
            font-size: 12pt;
        }

        table, table .table {
            border-collapse: collapse;
            background: #fff;
            vertical-align: top;
            width: 100%
        }

        table, table .table thead tr th {
            font-size: 15pt;

        }

        .form-check {
            display: inline-block;
            position: relative;
            width: 50px;
            height: 25px;
        }

        .padding-10 {
            padding: 10px
        }

        .padding-8 {
            padding: 8px
        }

        .padding-5 {
            padding: 5px
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .border-putus {
            border-bottom: 1px dotted #666;
            border-top: 1px dotted #666;
        }

        .no-border-bottom {
            border-bottom: 0px;
        }

        .no-border-top {
            border-top: 0px;
        }

        .no-border-right {
            border-right: 0px;
        }

        .no-border-left {
            border-left: 0px;
        }

        .border-all {
            border: 1px solid #666;
        }

    </style>
</head>
<body class="body" style="padding: 30px">
{{ $slot }}
</body>
</html>
