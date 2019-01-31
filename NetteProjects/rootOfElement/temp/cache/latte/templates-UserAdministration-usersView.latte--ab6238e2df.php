<?php
// source: /home/xs025400/rootofelement/rootOfElement/app/presenters/templates/UserAdministration/usersView.latte

use Latte\Runtime as LR;

class Templateab6238e2df extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'_ajaxChangeUsersViewContent' => 'blockAjaxChangeUsersViewContent',
	];

	public $blockTypes = [
		'content' => 'html',
		'_ajaxChangeUsersViewContent' => 'html',
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
		if (isset($this->params['key'])) trigger_error('Variable $key overwritten in foreach on line 17');
		if (isset($this->params['item'])) trigger_error('Variable $item overwritten in foreach on line 17');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>


<div class="container">

    <div class="usersView">

        <div class="usersViewContent">

<?php
		if ($user->isInRole('admin')) {
?>

            <h3>Prehľad používateľov</h3>

<div id="<?php echo htmlSpecialChars($this->global->snippetDriver->getHtmlId('ajaxChangeUsersViewContent')) ?>"><?php
			$this->renderBlock('_ajaxChangeUsersViewContent', $this->params) ?></div>
<?php
		}
		else {
?>

                <p>K tomuto obsahu nemáte povolenie na prístup</p>

<?php
		}
?>

        </div>
    </div>
</div>

<?php
	}


	function blockAjaxChangeUsersViewContent($_args)
	{
		extract($_args);
		$this->global->snippetDriver->enter("ajaxChangeUsersViewContent", "static");
		$iterations = 0;
		foreach ($currentUsers as $key => $item) {
			if ($item->username != "default") {
?>
                        <div class="usersViewTableContent">
                             <table class="usersViewItem">
                                    <tr> <th>Používateľské meno</th> <td><?php echo LR\Filters::escapeHtmlText($item->username) /* line 21 */ ?></td> </tr>
                                    <tr> <th>Meno</th> <td><?php echo LR\Filters::escapeHtmlText($item->name) /* line 22 */ ?></td> </tr>
                                    <tr> <th>Priezvisko</th> <td><?php echo LR\Filters::escapeHtmlText($item->surname) /* line 23 */ ?></td> </tr>
                                    <tr> <th>E-mail</th> <td><?php echo LR\Filters::escapeHtmlText($item->email) /* line 24 */ ?></td> </tr>
                                    <tr> <th>Mesto</th> <td><?php echo LR\Filters::escapeHtmlText($item->city) /* line 25 */ ?></td> </tr>
                                    <tr> <th>Štát</th> <td><?php echo LR\Filters::escapeHtmlText($item->state) /* line 26 */ ?></td> </tr>
                                    <tr> <th>Rola</th> <td><?php echo LR\Filters::escapeHtmlText($item->role) /* line 27 */ ?></td> </tr>
                                    <tr> <td class="deleteUser" align="center" colspan="2"><a class="ajax" href="<?php
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("deleteUser!", [$item->id])) ?>"><i class="fa fa-remove"></i></a> </td> </tr>
                             </table>
                        </div>
<?php
			}
			$iterations++;
		}
		$this->global->snippetDriver->leave();
		
	}

}
