<?php
// source: /home/xs025400/rootofelement/rootOfElement/app/presenters/templates/Homepage/default.latte

use Latte\Runtime as LR;

class Template0b9f816161 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'_ajaxChangeCurrentElementContent' => 'blockAjaxChangeCurrentElementContent',
		'_ajaxChangePerTab' => 'blockAjaxChangePerTab',
	];

	public $blockTypes = [
		'content' => 'html',
		'_ajaxChangeCurrentElementContent' => 'html',
		'_ajaxChangePerTab' => 'html',
	];


	function main()
	{
		extract($this->params);
?>
<!DOCTYPE html>
<html>
<head>

</head>

<body>	

<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
?>

</body>
</html><?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['menuKey'])) trigger_error('Variable $menuKey overwritten in foreach on line 227');
		if (isset($this->params['menuItem'])) trigger_error('Variable $menuItem overwritten in foreach on line 227');
		if (isset($this->params['ptKey'])) trigger_error('Variable $ptKey overwritten in foreach on line 262, 409');
		if (isset($this->params['ptItem'])) trigger_error('Variable $ptItem overwritten in foreach on line 262, 409');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<div id="elementModal" class="w3-modal" style="z-index: 4000;">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:1300px;">

<div id="<?php echo htmlSpecialChars($this->global->snippetDriver->getHtmlId('ajaxChangeCurrentElementContent')) ?>"><?php
		$this->renderBlock('_ajaxChangeCurrentElementContent', $this->params) ?></div>

        <script>

            function redrawPropertiesAfterSave()
            {
                document.getElementById('textAreaProperties').innerHTML = document.getElementById('editorProperties').innerHTML;
                document.getElementById('elementModalPropertiesText').innerHTML = document.getElementById('editorProperties').innerHTML;
            }

            function redrawNoteAfterSave()
            {
                document.getElementById('textAreaNote').innerHTML = document.getElementById('editorNote').innerHTML;
                document.getElementById('elementModalNoteText').innerHTML = document.getElementById('editorNote').innerHTML;
            }

           function switchElementEditProperties() {
                if(document.getElementById('elementEditPropertiesText').style.display == "none")
                {
                    document.getElementById('elementEditPropertiesText').style.display = "block";
                    document.getElementById('saveElementProperties').style.display = "block";
                } else {
                    document.getElementById('elementEditPropertiesText').style.display = "none";
                    document.getElementById('saveElementProperties').style.display = "none";
                }

            }

            function switchElementEditNote() {
                if(document.getElementById('elementEditNoteText').style.display == "none")
                {
                    document.getElementById('elementEditNoteText').style.display = "block";
                    document.getElementById('saveElementNote').style.display = "block";
                } else {
                    document.getElementById('elementEditNoteText').style.display = "none";
                    document.getElementById('saveElementNote').style.display = "none";
                }

            }

           function textAreaAdjust(o) {
               o.style.height = "1px";
               o.style.height = (25+o.scrollHeight)+"px";
           }

        </script>


   </div>

        <div class="w3-container w3-border-top  w3-light-grey elementModalFoot">
            <button onclick="document.getElementById('elementModal').style.display='none'" type="button" class="w3-button w3-red elementContentEscButton">Zrušiť</button>
        </div>

    </div>
</div>

<div class="defaultContent">






<div class="menuCollapse">



    <nav class="navbar navbar-expand-lg navbar-light sticky-top">

        <button id="classificationButton" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbarKat">
            <span class="classificationText"> Klasifikácia</span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbarKat">
            <ul class="menu">

<?php
		$iterations = 0;
		foreach ($menu as $menuKey => $menuItem) {
			?>                        <li class="classificationPanelItem">  <div class="nav-item"><a style="background-color: #<?php
			echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($menuItem->color)) /* line 228 */ ?>;" class="ajax" onclick="hideMenu();" href="<?php
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("changePeriodicContent!", [$menuItem->keyName])) ?>"><?php
			echo LR\Filters::escapeHtmlText($menuItem->name) /* line 228 */ ?></a></div> </li>
<?php
			$iterations++;
		}
?>

                <script>
                     function hideMenu()
                     {
                         document.getElementById('classificationButton').classList.toggle('collapsed');
                         document.getElementById('collapsibleNavbarKat').classList.toggle('show');
                     }
                </script>


            </ul>
        </div>

    </nav>



</div>


<div class="container-fluid">

    <div class="periodicTableContent">
<div id="<?php echo htmlSpecialChars($this->global->snippetDriver->getHtmlId('ajaxChangePerTab')) ?>"><?php
		$this->renderBlock('_ajaxChangePerTab', $this->params) ?></div>


    </div>

</div>

</div>

<?php
	}


	function blockAjaxChangeCurrentElementContent($_args)
	{
		extract($_args);
		$this->global->snippetDriver->enter("ajaxChangeCurrentElementContent", "static");
?>

    <div class="w3-center"><br>
        <span onclick="document.getElementById('elementModal').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
        <br>
        <h3 class="elementModalSlovakTitle"><?php echo LR\Filters::escapeHtmlText($currentElement->slovakName) /* line 19 */ ?></h3>
    </div>

   <div class="w3-container">



    <table class="elementModalInfo">
        <tr> <th>Polomer kruhu</th> <td><?php echo LR\Filters::escapeHtmlText($currentElement->circleRadius) /* line 27 */ ?></td> </tr>
        <tr> <th>Priemer kruhu</th> <td>

<?php
		if ($currentElement->circleRadius == 0) {
?>
                    <span>-</span>
<?php
		}
		else {
			?>                    <?php echo LR\Filters::escapeHtmlText($currentElement->circleRadius * 2) /* line 33 */ ?>

<?php
		}
?>

               </td> </tr>
        <tr> <th>Latinský názov</th> <td><?php echo LR\Filters::escapeHtmlText($currentElement->latinName) /* line 37 */ ?></td> </tr>
        <tr> <th>Anglický názov</th> <td><?php echo LR\Filters::escapeHtmlText($currentElement->englishName) /* line 38 */ ?></td> </tr>
        <tr> <th>Chemická značka</th> <td><?php echo LR\Filters::escapeHtmlText($currentElement->chemicalSymbol) /* line 39 */ ?></td> </tr>
        <tr> <th>Protónové číslo</th> <td><?php echo LR\Filters::escapeHtmlText($currentElement->atomicNumber) /* line 40 */ ?></td> </tr>
        <tr> <th>Rel. atómová hmotnosť</th> <td><?php echo LR\Filters::escapeHtmlText($currentElement->relativeAtomicMass) /* line 41 */ ?></td> </tr>
        <tr> <th>Perióda</th> <td><?php echo LR\Filters::escapeHtmlText($currentElement->period) /* line 42 */ ?></td> </tr>
        <tr> <th>Klasifikácia</th> <td><?php echo LR\Filters::escapeHtmlText($currentElement->classificationName) /* line 43 */ ?></td> </tr>
        <tr> <th>Teplota topenia(°C)</th> <td><?php echo LR\Filters::escapeHtmlText($currentElement->meltingPoint) /* line 44 */ ?></td> </tr>
        <tr> <th>Teplota varu(°C)</th> <td><?php echo LR\Filters::escapeHtmlText($currentElement->boilingPoint) /* line 45 */ ?></td> </tr>
        <tr> <th>Kritická teplota(°C)</th> <td><?php echo LR\Filters::escapeHtmlText($currentElement->criticalTemperature) /* line 46 */ ?></td> </tr>
        <tr> <th>Teplota samozapálenia(°C)</th> <td><?php echo LR\Filters::escapeHtmlText($currentElement->ignitionTemperature) /* line 47 */ ?></td> </tr>
        <tr> <th>Hustota(g cm<sup>-3</sup>)</th> <td><?php echo LR\Filters::escapeHtmlText($currentElement->density) /* line 48 */ ?></td> </tr>
        <tr> <th>Kritický tlak(MPa)</th> <td><?php echo LR\Filters::escapeHtmlText($currentElement->criticalPressure) /* line 49 */ ?></td> </tr>
        <tr> <th>Elektrónova konfigurácia</th> <td><?php echo LR\Filters::escapeHtmlText($currentElement->electronConfiguration) /* line 50 */ ?></td> </tr>
        <tr> <th>Atómový polomer(pm)</th> <td><?php echo LR\Filters::escapeHtmlText($currentElement->atomicRadius) /* line 51 */ ?></td> </tr>
    </table>

    <p class="elementModalPropertiesLabel">Vlastnosti</p>
    <div id="elementModalPropertiesText" class="elementModalProperties">
        <?php echo $currentElement->properties /* line 56 */ ?>

    </div>

<?php
		if ($user->loggedIn) {
?>

    <button class="editElementProperties w3-button w3-blue" type="button" onclick="switchElementEditProperties();">Editovať vlastnosti</button>
    <br>

    <?php
			/* line 64 */
			echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $this->global->formsStack[] = $this->global->uiControl["editElementPropertiesForm-$currentElement->id"], []);
?>


       <div id="elementEditPropertiesText" style="display: none;">

        <div class="toolbar">

            <button class="tool-items fa fa-underline"  onclick="document.execCommand('underline', false, '');">
            </button>

            <button class="tool-items fa fa-italic" onclick="document.execCommand('italic', false, '');">
            </button>


            <button class="tool-items fa fa-bold" onclick="document.execCommand('bold', false, '');">
            </button>

        </div>

        <div class="centerProperties">
            <div id="editorProperties" class="editorProperties" contenteditable>
                <?php echo $currentElement->properties /* line 84 */ ?>

            </div>
        </div>

       </div>

    <textarea id="textAreaProperties" style="display: none;" onkeyup="textAreaAdjust(this)" <?php
			$_input = end($this->global->formsStack)["propertiesText"];
			echo $_input->getControlPart()->addAttributes(array (
			'id' => NULL,
			'style' => NULL,
			'onkeyup' => NULL,
			))->attributes() ?>>
<?php echo $_input->getControl()->getHtml() ?>    </textarea>

        <input id="saveElementProperties" type="submit" onclick="redrawPropertiesAfterSave()" class="ajax" style="display: none;"<?php
			$_input = end($this->global->formsStack)["save"];
			echo $_input->getControlPart()->addAttributes(array (
			'id' => NULL,
			'type' => NULL,
			'onclick' => NULL,
			'class' => NULL,
			'style' => NULL,
			))->attributes() ?>>
    <?php
			echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack));
?>


<?php
		}
?>

    <p class="elementModalNoteLabel">Poznámka</p>
    <div id="elementModalNoteText" class="elementModalNote">
        <?php echo $currentElement->note /* line 101 */ ?>

    </div>

<?php
		if ($user->loggedIn) {
?>

    <button class="editElementNote w3-button w3-blue" type="button" onclick="switchElementEditNote();">Editovať poznámku</button>
    <br>

    <?php
			/* line 109 */
			echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $this->global->formsStack[] = $this->global->uiControl["editElementNoteForm-$currentElement->id"], []);
?>


        <div id="elementEditNoteText" style="display: none;">


            <div class="toolbar">

                <button class="tool-items fa fa-underline"  onclick="document.execCommand('underline', false, '');">
                </button>

                <button class="tool-items fa fa-italic" onclick="document.execCommand('italic', false, '');">
                </button>


                <button class="tool-items fa fa-bold" onclick="document.execCommand('bold', false, '');">
                </button>

            </div>

            <div class="centerNote">
                <div id="editorNote" class="editorNote" contenteditable>
                    <?php echo $currentElement->note /* line 130 */ ?>

                </div>
            </div>

        </div>

            <textarea id="textAreaNote" style="display: none;" onkeyup="textAreaAdjust(this)" <?php
			$_input = end($this->global->formsStack)["noteText"];
			echo $_input->getControlPart()->addAttributes(array (
			'id' => NULL,
			'style' => NULL,
			'onkeyup' => NULL,
			))->attributes() ?>>
<?php echo $_input->getControl()->getHtml() ?>    </textarea>

            <input id="saveElementNote" type="submit" onclick="redrawNoteAfterSave()" class="ajax" style="display: none;"<?php
			$_input = end($this->global->formsStack)["save"];
			echo $_input->getControlPart()->addAttributes(array (
			'id' => NULL,
			'type' => NULL,
			'onclick' => NULL,
			'class' => NULL,
			'style' => NULL,
			))->attributes() ?>>


    <?php
			echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack));
?>


<?php
		}
		else {
?>
            <br>

<?php
		}
?>

<?php
		$this->global->snippetDriver->leave();
		
	}


	function blockAjaxChangePerTab($_args)
	{
		extract($_args);
		$this->global->snippetDriver->enter("ajaxChangePerTab", "static");
?>

        <table class="periodicTable">

<?php
		if ($classificationKeyName == "#all") {
?>



<?php
			$index = 1;
			$iterations = 0;
			foreach ($perTable as $ptKey => $ptItem) {
?>


<?php
				$specialColor = "firebrick";
?>

<?php
				if ($ptItem->color == "DE432E") {
?>

<?php
					$specialColor = "wheat";
?>

<?php
				}
?>


<?php
				if ($index <= 125) {
?>

<?php
					if ($index % 18 == 0 || $index == 1) {
?>
                     <tr>
<?php
					}
?>

<?php
					if ($index == 2) {
?>
                    <td style="border: none;" colspan="16">

                        <form class="selectElementValueForm">
                            <label class="radio-inline selectElementValueLabel">
                                <input class="selectElementValue" onclick="changeElementsValue('diameter')" type="radio" name="optradio" checked>Priemer kruhu
                            </label>
                            <label class="radio-inline selectElementValueLabel">
                                <input class="selectElementValue" onclick="changeElementsValue('radius')" type="radio" name="optradio">Polomer kruhu
                            </label>
                            <label class="radio-inline selectElementValueLabel">
                                <input class="selectElementValue" onclick="changeElementsValue('ram')" type="radio" name="optradio">Relatívna atómová hmotnosť
                            </label>
                        </form>

                    </td>
<?php
						$index = $index + 15;
					}
?>

<?php
					if ($index == 20) {
?>
                    <td colspan="10" >&nbsp;</td>
<?php
						$index = $index + 10;
					}
?>

<?php
					if ($index == 38) {
?>
                    <td style="border: none;" colspan="10">&nbsp;</td>
<?php
						$index = $index + 10;
					}
?>

                <td style="border: 1px solid black;"><div style="background-color: #<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($ptItem->color)) /* line 309 */ ?>;"><span class="atomicNumberBadge"><?php
					echo LR\Filters::escapeHtmlText($ptItem->atomicNumber) /* line 309 */ ?></span><a class="ajax" onclick="document.getElementById('elementModal').style.display = 'block';" href="<?php
					echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("changeElementContent!", [$ptItem->id])) ?>"><?php
					echo LR\Filters::escapeHtmlText($ptItem->chemicalSymbol) /* line 309 */ ?>

                        <div class="elementValue">
                         <span class="elementRadius" style="color: <?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($specialColor)) /* line 311 */ ?>; display: none;">
<?php
					if ($ptItem->circleRadius == 0) {
?>
                                 <span>-</span>
<?php
					}
					else {
						?>                                 <?php echo LR\Filters::escapeHtmlText($ptItem->circleRadius) /* line 315 */ ?>

<?php
					}
?>
                         </span>

                         <span class="elementDiameter" style="color: <?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($specialColor)) /* line 319 */ ?>;">
<?php
					if ($ptItem->circleRadius == 0) {
?>
                                 <span>-</span>
<?php
					}
					else {
						?>                                 <?php echo LR\Filters::escapeHtmlText($ptItem->circleRadius * 2) /* line 323 */ ?>

<?php
					}
?>
                         </span>

                         <span class="elementRam" style="color: <?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($specialColor)) /* line 327 */ ?>; display: none;">
                                 <?php echo LR\Filters::escapeHtmlText($ptItem->relativeAtomicMass) /* line 328 */ ?>

                         </span>
                        </div>

                        </a></div></td>

<?php
					$index = $index + 1;
?>

<?php
				}
				else {
?>

<?php
					if ($index == 126) {
?>

                         <tr>
                             <td colspan="18" >&nbsp;</td>
<?php
						$index = $index + 18;
					}
?>

<?php
					if ($index % 18 == 0) {
?>
                                  <tr>
                                      <td colspan="3" >&nbsp;</td>
<?php
						$index = $index + 3;
					}
?>


                              <td style="border: 1px solid black;"><div style="background-color: #<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($ptItem->color)) /* line 352 */ ?>;"><span class="atomicNumberBadge"><?php
					echo LR\Filters::escapeHtmlText($ptItem->atomicNumber) /* line 352 */ ?></span><a class="ajax" onclick="document.getElementById('elementModal').style.display = 'block';" href="<?php
					echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("changeElementContent!", [$ptItem->id])) ?>"><?php
					echo LR\Filters::escapeHtmlText($ptItem->chemicalSymbol) /* line 352 */ ?>


                                          <div class="elementValue">
                                              <span class="elementRadius" style="color: <?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($specialColor)) /* line 355 */ ?>; display: none;">
<?php
					if ($ptItem->circleRadius == 0) {
?>
                                                  <span>-</span>
<?php
					}
					else {
						?>                                                 <?php echo LR\Filters::escapeHtmlText($ptItem->circleRadius) /* line 359 */ ?>

<?php
					}
?>
                                               </span>

                                              <span class="elementDiameter" style="color: <?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($specialColor)) /* line 363 */ ?>;">
<?php
					if ($ptItem->circleRadius == 0) {
?>
                                                 <span>-</span>
<?php
					}
					else {
						?>                                                   <?php echo LR\Filters::escapeHtmlText($ptItem->circleRadius * 2) /* line 367 */ ?>

<?php
					}
?>
                                             </span>

                                              <span class="elementRam" style="color: <?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($specialColor)) /* line 371 */ ?>; display: none;">
                                                   <?php echo LR\Filters::escapeHtmlText($ptItem->relativeAtomicMass) /* line 372 */ ?>

                                              </span>
                                          </div>

                                      </a></div></td>

<?php
					if ($index == 160) {
?>
                                    <td>&nbsp;</td>
<?php
						$index = $index + 1;
					}
?>

<?php
					$index = $index + 1;
?>


<?php
				}
?>


<?php
				$iterations++;
			}
?>



<?php
		}
		else {
?>

                <form class="selectElementValueForm">
                    <label class="radio-inline selectElementValueLabel" style="margin-left: 25px; margin-top: 20px;">
                        <input class="selectElementValue" onclick="changeElementsValue('diameter')" type="radio" name="optradio" checked>Priemer kruhu
                    </label>
                    <label class="radio-inline selectElementValueLabel">
                        <input class="selectElementValue" onclick="changeElementsValue('radius')" type="radio" name="optradio">Polomer kruhu
                    </label>
                    <label class="radio-inline selectElementValueLabel">
                        <input class="selectElementValue" onclick="changeElementsValue('ram')" type="radio" name="optradio">Relatívna atómová hmotnosť
                    </label>
                </form>


<?php
			$index = 0;
			$iterations = 0;
			foreach ($perTable as $ptKey => $ptItem) {
?>

<?php
				$specialColor = "firebrick";
?>

<?php
				if ($ptItem->color == "DE432E") {
?>

<?php
					$specialColor = "wheat";
?>

<?php
				}
?>


<?php
				if ($index % 9 == 0) {
?>
                                   <tr>
<?php
				}
?>

                       <td style="border: 1px solid black;"><div style="background-color: #<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($ptItem->color)) /* line 424 */ ?>;"><span class="atomicNumberBadge"><?php
				echo LR\Filters::escapeHtmlText($ptItem->atomicNumber) /* line 424 */ ?></span><a class="ajax" onclick="document.getElementById('elementModal').style.display = 'block';" href="<?php
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("changeElementContent!", [$ptItem->id])) ?>"><?php
				echo LR\Filters::escapeHtmlText($ptItem->chemicalSymbol) /* line 424 */ ?>


                                   <div class="elementValue">
                                              <span class="elementRadius" style="color: <?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($specialColor)) /* line 427 */ ?>; display: none;">
<?php
				if ($ptItem->circleRadius == 0) {
?>
                                                  <span>-</span>
<?php
				}
				else {
					?>                                                  <?php echo LR\Filters::escapeHtmlText($ptItem->circleRadius) /* line 431 */ ?>

<?php
				}
?>
                                               </span>

                                       <span class="elementDiameter" style="color: <?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($specialColor)) /* line 435 */ ?>;">
<?php
				if ($ptItem->circleRadius == 0) {
?>
                                                  <span>-</span>
<?php
				}
				else {
					?>                                                  <?php echo LR\Filters::escapeHtmlText($ptItem->circleRadius * 2) /* line 439 */ ?>

<?php
				}
?>
                                             </span>

                                       <span class="elementRam" style="color: <?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss($specialColor)) /* line 443 */ ?>; display: none;">
                                                   <?php echo LR\Filters::escapeHtmlText($ptItem->relativeAtomicMass) /* line 444 */ ?>

                                              </span>
                                   </div>

                               </a></div></td>
<?php
				$index = $index + 1;
				$iterations++;
			}
		}
?>
        </table>

            <script>
                function changeElementsValue(type)
                {
                    if(type == "diameter")
                    {

                        $('span[class="elementDiameter"]').each(function(){
                            $(this).show();
                        });

                        $('span[class="elementRadius"]').each(function(){
                            $(this).hide();
                        });

                        $('span[class="elementRam"]').each(function(){
                            $(this).hide();
                        });


                    } else if(type == "radius")
                    {
                        $('span[class="elementDiameter"]').each(function(){
                            $(this).hide();
                        });

                        $('span[class="elementRadius"]').each(function(){
                            $(this).show();
                        });

                        $('span[class="elementRam"]').each(function(){
                            $(this).hide();
                        });
                    } else if(type == "ram")
                    {
                        $('span[class="elementDiameter"]').each(function(){
                            $(this).hide();
                        });

                        $('span[class="elementRadius"]').each(function(){
                            $(this).hide();
                        });

                        $('span[class="elementRam"]').each(function(){
                            $(this).show();
                        });
                    }

                }
            </script>


<?php
		$this->global->snippetDriver->leave();
		
	}

}
