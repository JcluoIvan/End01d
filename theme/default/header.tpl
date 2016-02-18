<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}
</head>
    <body id="header">
        <header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/page/home/main.php" target="ifr-right">Endold</a>
                </div>
                <nav class="collapse navbar-collapse bs-navbar-collapse">
                    <ul class="nav navbar-nav">
                        {{foreach from=$pages item=row}}
                            <li>
                                <a class="list-group-item" href="{{$row.url}}">{{$row.label}}</a>
                            </li>
                        {{/foreach}}
                    </ul>
                </nav>
            </div>
        </header>
        <script type="text/javascript" src="/js/header.js?{{$smarty.now}}"></script>
    </body>
</html>
