<script type="text/javascript">
    
	startList = function()
	{
		navRoot = document.getElementById("nav");
		for (i=0; i<navRoot.childNodes.length; i++)
		{
			node = navRoot.childNodes[i];
			if (node.nodeName=="LI"){
				node.onmouseover=function()
				{
					if (this.className=='selected'){
						this.oldClassName='selected';
					}
					this.className="allum selected";
				}
				node.onmouseout=function()
				{
					if (this.oldClassName!='selected'){
						this.className='rien';
					} else {
						this.className='selected';
					}
				}
			}
		}
	}
	//window.onload=startList;
</script>

<ul id="navigation" class="sf-navbar">
    <?php Menu::drawMenu($array_menus, 'dashboard'); ?>
</ul>

