<?php
/**
 * Freifunk skin
 *
 * @todo document
 * @file
 * @ingroup Skins
 */

if( !defined( 'MEDIAWIKI' ) )
	die( -1 );

/**
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 * @todo document
 * @ingroup Skins
 */
class SkinFreifunk extends SkinTemplate {
    /** Using Freifunk. */
    function initPage( OutputPage $out ) {

		SkinTemplate::initPage( $out );
		$this->skinname  = 'Freifunk';
		$this->stylename = 'Freifunk';
		$this->template  = 'FreifunkTemplate';
	}
}

/**
 * @todo document
 * @ingroup Skins
 */
class FreifunkTemplate extends QuickTemplate {
	var $skin;
	/**
	 * Template filter callback for Freifunk skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 *
	 * @access private
	 */
	function execute() {
		global $wgRequest;
		$this->skin = $skin = $this->data['skin'];
		$action = $wgRequest->getText( 'action' );

		// Suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="<?php $this->text('xhtmldefaultnamespace') ?>" <?php
	foreach($this->data['xhtmlnamespaces'] as $tag => $ns) {
		?>xmlns:<?php echo "{$tag}=\"{$ns}\" ";
	} ?>xml:lang="<?php $this->text('lang') ?>" lang="<?php $this->text('lang') ?>" dir="<?php $this->text('dir') ?>">
	<head>
		<meta http-equiv="Content-Type" content="<?php $this->text('mimetype') ?>; charset=<?php $this->text('charset') ?>" />
		<?php $this->html('headlinks') ?>
		<title><?php $this->text('pagetitle') ?></title>
                <link href="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/css/central_wiki.css" rel="stylesheet" type="text/css"/>
                <!--[if lte IE 7]>
                <link href="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/css/central_patches.css" rel="stylesheet" type="text/css" />
                <![endif]-->

		<!-- Head Scripts -->
<?php $this->html('headscripts') ?>
<?php	if($this->data['jsvarurl']) { ?>
		<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('jsvarurl') ?>"><!-- site js --></script>
<?php	} ?>
<?php	if($this->data['pagecss']) { ?>
		<style type="text/css"><?php $this->html('pagecss') ?></style>
<?php	}
		if($this->data['usercss']) { ?>
		<style type="text/css"><?php $this->html('usercss') ?></style>
<?php	}
		if($this->data['userjs']) { ?>
		<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('userjs' ) ?>"></script>
<?php	}
		if($this->data['userjsprev']) { ?>
		<script type="<?php $this->text('jsmimetype') ?>"><?php $this->html('userjsprev') ?></script>
<?php	}
		if($this->data['trackbackhtml']) print $this->data['trackbackhtml']; ?>
	</head>
<body<?php if($this->data['body_ondblclick']) { ?> ondblclick="<?php $this->text('body_ondblclick') ?>"<?php } ?>
<?php if($this->data['body_onload']) { ?> onload="<?php $this->text('body_onload') ?>"<?php } ?>
 class="mediawiki <?php $this->text('nsclass') ?> <?php $this->text('dir') ?> <?php $this->text('pageclass') ?>">

<div id="page_margins">
	<div id="page">
		<div id="header">
			<div id="topnav">
				<!-- start: skip link navigation -->
				<a class="skip" href="#navigation" title="skip link">Skip to the navigation</a><span class="hideme">.</span>
				<a class="skip" href="#content" title="skip link">Skip to the content</a><span class="hideme">.</span>
				<!-- end: skip link navigation -->
				<span><?php
                    $personalUrls = '';
                    foreach($this->data['personal_urls'] as $key => $item) {
                            $personalUrls .= '<a href="'.htmlspecialchars($item['href']).'"';
                            $personalUrls .= ' title="'.$skin->tooltipAndAccesskeyAttribs('pt-'.$key)['title'].'" accesskey="'.$skin->tooltipAndAccesskeyAttribs('pt-'.$key)['accesskey'].'"';
                            if(!empty($item['class'])) {
                                $personalUrls .= ' class="'.htmlspecialchars($item['class']).'"';
                            }
                            $personalUrls .= '>'.htmlspecialchars($item['text']).'</a>';
                            $notlastitem = next($this->data['personal_urls']);
                            $personalUrls .= ' | ';
                    } /* foreach */
                    /* remove the last " | " */
                    echo substr($personalUrls, 0, strlen($personalUrls) - 3); ?></span>
		        </div>
	         	<div id="headerbg">
                        </div>
                        <h1>Freifunk Potsdam | Wiki</h1>
                        <span>Die freie WLAN-Community aus Potsdam &#8226; Internet für alle!</span>
                </div>
		<!-- begin: main navigation #nav -->
		<div id="nav"> <a id="navigation" name="navigation"></a>
			<!-- skiplink anchor: navigation -->
			<div id="nav_main">
				<ul>
					<li><a href="http://blog.freifunk-potsdam.de/">Neues</a></li>
					<li id="current"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['mainpage']['href']); ?>" title="<?php echo $skin->tooltipAndAccesskeyAttribs('n-mainpage')['title']; ?>" accesskey="<?php echo $skin->tooltipAndAccesskeyAttribs('n-mainpage')['accesskey']; ?>">Wiki</a></li>
					<li><a href="http://forum.freifunk-potsdam.de/">Forum</a></li>
					<li><a href="http://karte.freifunk-potsdam.de/">Karte</a></li>
                    <li><a href="http://bilder.freifunk-potsdam.de/">Galerie</a></li>
				</ul>
				<div class="searchbox">
                    <form id="searchForm" name="searchForm" action="<?php $this->text('searchaction') ?>">
                      <input class="suchBox" type="text" onblur="this.value='Suchbegriff eingeben...'" onclick="this.value=''" value="Suchbegriff eingeben..." name="search"/>
                    </form>
                </div>
			</div>
            <div id="nav_sub">
                <ul><?php
                    foreach($this->data['content_actions'] as $key => $tab) {
                        echo '
				 <li id="ca-' . Sanitizer::escapeId($key).'"';
					echo'><span><a href="'.htmlspecialchars($tab['href']).'" ';
					if( $tab['class'] ) {
						echo ' class="'.htmlspecialchars($tab['class']).'"';
					}
					# We don't want to give the watch tab an accesskey if the
					# page is being edited, because that conflicts with the
					# accesskey on the watch checkbox.  We also don't want to
					# give the edit tab an accesskey, because that's fairly su-
					# perfluous and conflicts with an accesskey (Ctrl-E) often
					# used for editing in Safari.
				 	if( in_array( $action, array( 'edit', 'submit' ) )
				 	&& in_array( $key, array( 'edit', 'watch', 'unwatch' ))) {
				 		echo $skin->tooltip( "ca-$key" );
				 	} else {
				 		echo ' title="'.$skin->tooltipAndAccesskeyAttribs('ca-'.$key)['title'].'" accesskey="'.$skin->tooltipAndAccesskeyAttribs('ca-'.$key)['accesskey'].'"';
				 	}
				 	echo '>'.htmlspecialchars($tab['text']).'</a></span></li>';
				} ?>
                </ul>
            </div>
		</div>
		<!-- end: main navigation -->

		<!-- begin: main content area #main -->
		<div id="main">
			<!-- begin: #col3 static column -->
			<div id="col3">
				<div id="col3_content" class="clearfix">
                    <a id="content" name="content"></a>
					<!-- skiplink anchor: Content -->
                    <a name="top" id="top"></a>
                    <?php if($this->data['sitenotice']) { ?><div id="siteNotice"><?php $this->html('sitenotice') ?></div><?php } ?>
                    <h1 class="firstHeading"><?php $this->data['displaytitle']!=""?$this->html('title'):$this->text('title') ?></h1>

                    <h3 id="siteSub"><?php $this->msg('tagline') ?></h3>
                    <div id="contentSub"><?php $this->html('subtitle') ?></div>
                    <?php if($this->data['undelete']) { ?><div id="contentSub2"><?php     $this->html('undelete') ?></div><?php } ?>
                    <?php if($this->data['newtalk'] ) { ?><div class="usermessage"><?php $this->html('newtalk')  ?></div><?php } ?>
                    <?php if($this->data['showjumplinks']) { ?><div id="jump-to-nav"><?php $this->msg('jumpto') ?> <a href="#column-one"><?php $this->msg('jumptonavigation') ?></a>, <a href="#searchInput"><?php $this->msg('jumptosearch') ?></a></div><?php } ?>
                    <!-- start content -->
                    <?php $this->html('bodytext') ?>
                    <?php if($this->data['catlinks']) { $this->html('catlinks'); } ?>
                    <!-- end content -->
				</div>
				<div id="ie_clearing">&nbsp;</div>
				<!-- End: IE Column Clearing -->
			</div>
			<!-- end: #col3 -->

            <script type="<?php $this->text('jsmimetype') ?>"> if (window.isMSIE55) fixalpha(); </script>

            <!-- Subtemplate: 3 Spalten mit 33/33/33 Teilung -->
            <div class="subcolumns coolsubcol">
                <div class="c33l">
                    <div class="subcl">
<?php
                        $sidebar = $this->data['sidebar'];
                        if ( !isset( $sidebar['TOOLBOX'] ) ) $sidebar['TOOLBOX'] = true;
                        if ( !isset( $sidebar['LANGUAGES'] ) ) $sidebar['LANGUAGES'] = true;
                        foreach ($sidebar as $boxName => $cont) {
                            if ( $boxName != 'TOOLBOX' &&  $boxName != 'LANGUAGES' ) {
                                $this->customBox( $boxName, $cont );
                            }
                        }
?>
                    </div>
                </div>
                <div class="c33l">
                    <div class="subcl">
                        <h3><?php $this->msg('toolbox') ?></h3>
<?php
                            foreach ($sidebar as $boxName => $cont) {
                                if ( $boxName == 'TOOLBOX' ) {
                                    $this->toolbox();
                                } elseif ( $boxName == 'LANGUAGES' ) {
                                      $this->languageBox();
                                }
                            }
?>
                    </div>
                </div>
                <div class="c33r">
                    <div class="subcr">
                        <h3>Metainfo</h3>
                        <ul>
<?php
                            $footerlinks = array(
                                'lastmod', 'viewcount', 'numberofwatchingusers', 'credits', 'copyright',
                                'privacy', 'about', 'disclaimer', 'tagline',
                            );
                            foreach( $footerlinks as $aLink ) {
                                if( isset( $this->data[$aLink] ) && $this->data[$aLink] ) {
?>                          <li><?php $this->html($aLink); ?></li><?php
                        }
		}
?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end: subcol -->

		</div>
		<!-- end: #main -->
		<!-- begin: #footer -->
		<div id="footer">Hinter diesen Seiten steckt ein <a href="">Mediawiki</a>, das Layout basiert auf <a href="http://www.yaml.de"> <img border="0" style="position: relative; top: 5px;" alt="based on YAML" src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/images/yaml_base.gif"/></a>.</div>
		<!-- end: #footer -->
	</div>
</div>
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
  _paq.push(["setCookieDomain", "*.freifunk-potsdam.de"]);
  _paq.push(["setDomains", ["*.freifunk-potsdam.de"]]);
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//piwik.rooot.de/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 1]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="//piwik.rooot.de/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->
<?php $this->html('bottomscripts'); /* JS call to runBodyOnloadHook */ ?>
<?php $this->html('reporttime') ?>
<?php if ( $this->data['debug'] ): ?>
<!-- Debug output:
<?php $this->text( 'debug' ); ?>
-->
<?php endif; ?>
</body>
</html>
<?php
	wfRestoreWarnings();
	} // end of execute() method

	/*************************************************************************************************/
	function toolbox() {
?>
<ul>
<?php
        if($this->data['notspecialpage']) {
?>
    <li id="t-whatlinkshere"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['whatlinkshere']['href']); ?>" title="<?php echo $this->skin->tooltipAndAccesskeyAttribs('t-whatlinkshere')['title']; ?>" accesskey="<?php echo $this->skin->tooltipAndAccesskeyAttribs('t-whatlinkshere')['accesskey']; ?>"><?php $this->msg('whatlinkshere') ?></a></li>
<?php
            if( $this->data['nav_urls']['recentchangeslinked'] ) {
?>
    <li id="t-recentchangeslinked"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['recentchangeslinked']['href']); ?>" title="<?php echo $this->skin->tooltipAndAccesskeyAttribs('t-recentchangeslinked')['title']; ?>" accesskey="<?php echo $this->skin->tooltipAndAccesskeyAttribs('t-recentchangeslinked')['accesskey']; ?>"><?php $this->msg('recentchangeslinked') ?></a></li>
<?php
            }
        }
		if(isset($this->data['nav_urls']['trackbacklink'])) {
?>
    <li id="t-trackbacklink"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['trackbacklink']['href']); ?>" title="<?php echo $this->skin->tooltipAndAccesskeyAttribs('t-trackbacklink')['title']; ?>" accesskey="<?php echo $this->skin->tooltipAndAccesskeyAttribs('t-trackbacklink')['accesskey']; ?>"><?php $this->msg('trackbacklink') ?></a></li>
<?php
        }
		if($this->data['feeds']) {
?>
    <li id="feedlinks"><?php
            foreach($this->data['feeds'] as $key => $feed) { ?>
<span id="feed-<?php echo Sanitizer::escapeId($key) ?>"><a href="<?php echo htmlspecialchars($feed['href']); ?>" title="<?php echo $this->skin->tooltipAndAccesskeyAttribs('feed-'.$key)['title']; ?>" accesskey="<?php echo $this->skin->tooltipAndAccesskeyAttribs('feed-'.$key)['accesskey'] ?>"><?php echo htmlspecialchars($feed['text']) ?></a>&nbsp;</span>
<?php
            }
?></li>
<?php
		}
		foreach( array('contributions', 'log', 'blockip', 'emailuser', 'upload', 'specialpages') as $special ) {

			if($this->data['nav_urls'][$special]) { ?>
    <li id="t-<?php echo $special ?>"><a href="<?php echo htmlspecialchars($this->data['nav_urls'][$special]['href']); ?>" title="<?php echo $this->skin->tooltipAndAccesskeyAttribs('t-'.$special)['title']; ?>" accesskey="<?php echo $this->skin->tooltipAndAccesskeyAttribs('t-'.$special)['accesskey']; ?>"><?php $this->msg($special) ?></a></li>
<?php
            }
		}
		if(!empty($this->data['nav_urls']['print']['href'])) {
?>
    <li id="t-print"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['print']['href']); ?>" title="<?php echo $this->skin->tooltipAndAccesskeyAttribs('t-print')['title']; ?>" accesskey="<?php echo $this->skin->tooltipAndAccesskeyAttribs('t-print')['accesskey'] ?>"><?php $this->msg('printableversion') ?></a></li>
<?php
        }
		if(!empty($this->data['nav_urls']['permalink']['href'])) {
?>
    <li id="t-permalink"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['permalink']['href']); ?>" title="<?php echo $this->skin->tooltipAndAccesskeyAttribs('t-permalink')['title']; ?>" accesskey="<?php echo $this->skin->tooltipAndAccesskeyAttribs('t-permalink')['accesskey']; ?>"><?php $this->msg('permalink') ?></a></li>
<?php
		} elseif ($this->data['nav_urls']['permalink']['href'] === '') {
?>
    <li id="t-ispermalink"<?php echo $this->skin->tooltip('t-ispermalink') ?>><?php $this->msg('permalink') ?></li>
<?php
		}

		wfRunHooks( 'FreifunkTemplateToolboxEnd', array( &$this ) );
		wfRunHooks( 'SkinTemplateToolboxEnd', array( &$this ) );
?>
			</ul>
<?php
	}

	/*************************************************************************************************/
	function languageBox() {
		if( $this->data['language_urls'] ) {
?>
	<div id="p-lang" class="portlet">
		<h3><?php $this->msg('otherlanguages') ?></h3>
		<div class="pBody">
			<ul>
<?php		foreach($this->data['language_urls'] as $langlink) { ?>
				<li class="<?php echo htmlspecialchars($langlink['class'])?>"><?php
				?><a href="<?php echo htmlspecialchars($langlink['href']) ?>"><?php echo $langlink['text'] ?></a></li>
<?php		} ?>
			</ul>
		</div>
	</div>
<?php
		}
	}

	/*************************************************************************************************/
	function customBox( $bar, $cont ) {
?>
		<h3><?php $out = wfMsg( $bar ); if (wfEmptyMsg($bar, $out)) echo $bar; else echo $out; ?></h3>
<?php   if ( is_array( $cont ) ) { ?>
			<ul>
<?php 			foreach($cont as $key => $val) { ?>
				<li id="<?php echo Sanitizer::escapeId($val['id']) ?>"<?php
					if ( $val['active'] ) { ?> class="active" <?php }
				?>><a href="<?php echo htmlspecialchars($val['href']); ?>" title="<?php echo $this->skin->tooltipAndAccesskeyAttribs($val['id'])['title']; ?>" accesskey="<?php echo $this->skin->tooltipAndAccesskeyAttribs($val['id'])['accesskey']; ?>"><?php echo htmlspecialchars($val['text']) ?></a></li>
<?php			} ?>
			</ul>
<?php   } else {
			# allow raw HTML block to be defined by extensions
			print $cont;
		}
        }
} // end of class
