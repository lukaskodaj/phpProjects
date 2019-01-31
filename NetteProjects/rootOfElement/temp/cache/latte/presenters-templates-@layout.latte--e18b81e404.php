<?php
// source: /home/xs025400/rootofelement/rootOfElement/app/presenters/templates/@layout.latte

use Latte\Runtime as LR;

class Templatee18b81e404 extends Latte\Runtime\Template
{
	public $blocks = [
		'scripts' => 'blockScripts',
	];

	public $blockTypes = [
		'scripts' => 'html',
	];


	function main()
	{
		extract($this->params);
?>
<!DOCTYPE html>
<html lang="sk">
<head>
	
	<title>Root of Element</title>

    <meta charset="utf-8">
    <meta name="description" content="Nette Framework Static Web">
<?php
		if (isset($robots)) {
			?>    <meta name="robots" content="<?php echo LR\Filters::escapeHtmlAttr($robots) /* line 9 */ ?>">
<?php
		}
?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 13 */ ?>/js/netteForms.js"></script>

    <link rel="shortcut icon" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 15 */ ?>/pizzaicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link rel="shortcut icon" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 20 */ ?>/images/atom2icon.ico" type="image/x-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 23 */ ?>/bootstrap4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 26 */ ?>/bootstrap4/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 29 */ ?>/css/@layout.css">


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <script src="jquery-3.3.1.min.js"></script>

<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('scripts', get_defined_vars());
?>

</head>

<body>


<nav class="navbar navbar-expand-md navbar-light">


    <span class="navbar-brand"><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:")) ?>"><img class="roeLogo" src="<?php
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 53 */ ?>/images/atom2.png" alt="Hlavná stránka"></a></span>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span> <i class="fa fa-bars"></i></span>
    </button>

    <div class="collapse navbar-collapse" id="collapsibleNavbar">

        <ul class="navbar-nav mr-auto">


        </ul>



        <ul class="navbar-nav ml-auto">

<?php
		if ($user->isInRole('admin')) {
			?>                <li class="mainPanelItem"> <div class="nav-item"><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("RoeManagement:management")) ?>">RoE manažment </a></div></li>
<?php
		}
?>

            <li class="mainPanelItem"> <div class="nav-item"><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Info:informations", ['notSend'])) ?>"> <span class="fa fa-info-circle"> </span> Informácie  </a></div></li>

<?php
		if (!$user->loggedIn) {
?>





           <li class="mainPanelItem"> <div class="nav-item"><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:up")) ?>"> <span class="fa fa-user-plus"> </span> Registrácia </a></div></li>
                <li class="mainPanelItem"> <div class="nav-item"><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:in")) ?>"> <span class="fa fa-sign-in"> </span> Prihlásiť sa </a></div></li>

<?php
		}
?>

<?php
		if ($user->loggedIn) {
?>

                <li class="mainPanelItem"> <div class="nav-item"><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:out")) ?>"> <span class="fa fa-sign-out"> </span> Odhlásiť sa </a></div></li>

<?php
		}
?>

        </ul>
    </div>
</nav>



<?php
		$this->renderBlock('content', $this->params, 'html');
?>

	
</body>


</html>
<?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockScripts($_args)
	{
		extract($_args);
		?>        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 41 */ ?>/js/nette.ajax.js"></script>
        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 42 */ ?>/js/main.js"></script>
<?php
	}

}
