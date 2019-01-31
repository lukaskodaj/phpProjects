<?php
// source: /home/xs025400/rootofelement/rootOfElement/app/presenters/templates/Sign/up.latte

use Latte\Runtime as LR;

class Template3e35b85542 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'title' => 'blockTitle',
	];

	public $blockTypes = [
		'content' => 'html',
		'title' => 'html',
	];


	function main()
	{
		extract($this->params);
?>


<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['key'])) trigger_error('Variable $key overwritten in foreach on line 77');
		if (isset($this->params['item'])) trigger_error('Variable $item overwritten in foreach on line 77');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>


<div class="container">

	<div class="registration">

		<div class="registrationContent">


<?php
		$this->renderBlock('title', get_defined_vars());
?>


		<?php
		/* line 16 */
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $this->global->formsStack[] = $this->global->uiControl["signUpForm"], []);
?>

			<label >Meno</label>
			<input type="text" class="w3-input w3-border w3-round-large"<?php
		$_input = end($this->global->formsStack)["name"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'class' => NULL,
		))->attributes() ?>>



			<label >Priezvisko</label>
			<input type="text" class="w3-input w3-border w3-round-large"<?php
		$_input = end($this->global->formsStack)["surname"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'class' => NULL,
		))->attributes() ?>>



			<label >Používateľské meno</label>
			<input class="w3-input w3-border w3-round-large" id="username" type="text" onkeyup="checkUsernameDuplicity()"<?php
		$_input = end($this->global->formsStack)["username"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'id' => NULL,
		'type' => NULL,
		'onkeyup' => NULL,
		))->attributes() ?>>

			<div id="usernameWarn" class="w3-panel w3-red" style="display: none; border-radius: 10px;">
				<p style="padding: 4px;">Používateľské meno už existuje</p>
			</div>


			<label >E-mail</label>
			<input type="text" class="w3-input w3-border w3-round-large"<?php
		$_input = end($this->global->formsStack)["email"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'class' => NULL,
		))->attributes() ?>>



			<label>Mesto</label>
			<input type="text" class="w3-input w3-border w3-round-large"<?php
		$_input = end($this->global->formsStack)["city"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'class' => NULL,
		))->attributes() ?>>


			<label class="stateRegLabel">Štát</label>
			<?php echo end($this->global->formsStack)["state"]->getControl() /* line 45 */ ?>



			<label>Heslo</label>
			<input class="w3-input w3-border w3-round-large" id="registrationPassword" type="password"<?php
		$_input = end($this->global->formsStack)["pwd"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'id' => NULL,
		'type' => NULL,
		))->attributes() ?>>

			<div id="passwordWarn" class="w3-panel w3-red" style="display: none; border-radius: 10px;">
				<p style="padding: 4px;">Heslo musí byť minimálne 10 znakov dlhé</p>
			</div>


			<label>Heslo(overenie)</label>
			<input type="password" class="w3-input w3-border w3-round-large"<?php
		$_input = end($this->global->formsStack)["pwd2"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'class' => NULL,
		))->attributes() ?>>


			<input class="registrationSendButton" id="sendButton"<?php
		$_input = end($this->global->formsStack)["send"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'id' => NULL,
		))->attributes() ?>>
		<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack));
?>


	</div>
	</div>
</div>



		<script>
			function checkUsernameDuplicity()
			{
                document.getElementById('username').style.color = "green";
                document.getElementById('usernameWarn').style.display = "none";
                document.getElementById("sendButton").disabled = false;


<?php
		$iterations = 0;
		foreach ($this->getParameter('users') as $key => $item) {
			?>					if(document.getElementById('username').value == <?php echo LR\Filters::escapeJs($item->username) /* line 78 */ ?>)
					{

					    document.getElementById('usernameWarn').style.display = "block";
					    document.getElementById('username').style.color = "red";
                        document.getElementById("sendButton").disabled = true;

					}
<?php
			$iterations++;
		}
?>
			}
		</script>


		<script>
            $('#registrationPassword').keyup(function(e) {

                var matches = this.value.match(/\d+/g);

                if(this.value.length < 10)
                {
                    document.getElementById('passwordWarn').style.display = "block";
                    document.getElementById("sendButton").disabled = true;
                    document.getElementById('registrationPassword').style.color = "red";

                } else {
                    document.getElementById('passwordWarn').style.display = "none";
                    document.getElementById("sendButton").disabled = false;
                    document.getElementById('registrationPassword').style.color = "green";
                }

            });
		</script>

<?php
	}


	function blockTitle($_args)
	{
		extract($_args);
?>		<h3>Registrácia</h3>
<?php
	}

}
