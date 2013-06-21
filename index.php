<?
/*

Daux.io
==================

Description
-----------

This is a tool for auto-generating documentation based on markdown files
located in the /docs folder of the project. To see all of the available
options and to read more about how to use the generator, visit:

http://daux.io


Author
------
Justin Walsh (Todaymade): justin@todaymade.com, @justin_walsh
Garrett Moon (Todaymade): garrett@todaymade.com, @garrett_moon


Feedback & Suggestions
----

To give us feedback or to suggest an idea, please create an request on the the
Github issue tracker:

https://github.com/justinwalsh/daux.io/issues

Bugs
----

To file bug reports please create an issue using the github issue tracker:

https://github.com/justinwalsh/daux.io/issues


Copyright and License
---------------------
Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are
met:

*	Redistributions of source code must retain the above copyright notice,
	this list of conditions and the following disclaimer.

*	Redistributions in binary form must reproduce the above copyright
	notice, this list of conditions and the following disclaimer in the
	documentation and/or other materials provided with the distribution.

This software is provided by the copyright holders and contributors "as
is" and any express or implied warranties, including, but not limited
to, the implied warranties of merchantability and fitness for a
particular purpose are disclaimed. In no event shall the copyright owner
or contributors be liable for any direct, indirect, incidental, special,
exemplary, or consequential damages (including, but not limited to,
procurement of substitute goods or services; loss of use, data, or
profits; or business interruption) however caused and on any theory of
liability, whether in contract, strict liability, or tort (including
negligence or otherwise) arising in any way out of the use of this
software, even if advised of the possibility of such damage.

*/

require_once('libs/functions.php');

$options = get_options();
$tree = get_tree("docs");
$homepage_url = homepage_url($tree);
$docs_url = docs_url($tree);

// Redirect to docs, if there is no homepage
if ($homepage && $homepage_url !== '/') {
	header('Location: '.$homepage_url);
}

?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<html>
<head>
	<title><?=$options['title']; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="<?=$options['tagline'];?>" />
	<meta name="author" content="<?=$options['title']; ?>">
	<? if ($options['colors']) { ?>
	<link rel="icon" href="/img/favicon.png" type="image/x-icon">
	<? } else { ?>
	<link rel="icon" href="/img/favicon-<?=$options['theme'];?>.png" type="image/x-icon">
	<? } ?>
	<!-- Mobile -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Font -->
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100' rel='stylesheet' type='text/css'>

	<!-- LESS -->
	<? if ($options['colors']) { ?>
		<style type="text/less">
			<? foreach($options['colors'] as $k => $v) { ?>
		    @<?=$k;?>: <?=$v;?>;
		    <? } ?>
		    @import "/less/import/daux-base.less";
		</style>
		<script src="/js/less.min.js"></script>
	<? } else { ?>
		<link rel="stylesheet" href="/css/daux-<?=$options['theme'];?>.css">
	<? } ?>

	<!-- hightlight.js -->
	<script src="/js/highlight.min.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>

	<!-- Navigation -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
	<script src="/js/custom.js"></script>
	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<? if ($homepage) { ?>
		<!-- Hompage -->
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="brand pull-left" href="<?=$homepage_url;?>"><?=$options['title']; ?></a>
					<p class="navbar-text pull-right">
						Generated by <a href="http://daux.io">Daux.io</a>
					</p>
				</div>
			</div>
		</div>

		<div class="homepage-hero well container-fluid">
			<div class="container">
				<div class="row">
					<div class="text-center span12">
						<? if ($options['tagline']) { ?>
							<h2><?=$options['tagline'];?></h2>
						<? } ?>
					</div>
				</div>
				<div class="row">
					<div class="span10 offset1">
						<? if ($options['image']) { ?>
							<img class="homepage-image" src="<?=$options['image'];?>" alt="<?=$options['title'];?>">
						<? } ?>
					</div>
				</div>
			</div>
		</div>

		<div class="hero-buttons container-fluid">
			<div class="container">
				<div class="row">
					<div class="text-center span12">
						<? if ($options['repo']) { ?>
							<a href="https://github.com/<?=$options['repo']; ?>" class="btn btn-secondary btn-hero">
								View On GitHub
							</a>
						<? } ?>
						<a href="<?=$docs_url;?>" class="btn btn-primary btn-hero">
							View Documentation
						</a>
					</div>
				</div>
			</div>
		</div>

		<div class="homepage-content container-fluid">
			<div class="container">
				<div class="row">
					<div class="span10 offset1">
						<? echo load_page($tree); ?>
					</div>
				</div>
			</div>
		</div>

		<div class="homepage-footer well container-fluid">
			<div class="container">
				<div class="row">
					<div class="span5 offset1">
						<? if (!empty($options['links'])) { ?>
							<ul class="footer-nav">
								<? foreach($options['links'] as $name => $url) { ?>
									<li><a href="<?=$url;?>" target="_blank"><?=$name;?></a></li>
								<? } ?>
							</ul>
						<? } ?>
					</div>
					<div class="span5">
						<div class="pull-right">
							<? if (!empty($options['twitter'])) { ?>
								<? foreach($options['twitter'] as $handle) { ?>
									<div class="twitter">
										<iframe allowtransparency="true" frameborder="0" scrolling="no" style="width:162px; height:20px;" src="https://platform.twitter.com/widgets/follow_button.html?screen_name=<?=$handle;?>&amp;show_count=false"></iframe>
									</div>
								<? } ?>
							<? } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

	<? } else { ?>
		<!-- Docs -->
		<? if ($options['repo']) { ?>
			<a href="https://github.com/<?=$options['repo']; ?>" target="_blank" id="github-ribbon"><img src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Fork me on GitHub"></a>
		<? } ?>
		<div class="container-fluid fluid-height wrapper">
			<div class="navbar navbar-fixed-top">
				<div class="navbar-inner">
					<a class="brand pull-left" href="<?=$homepage_url;?>"><?=$options['title']; ?></a>
					<p class="navbar-text pull-right">
						Generated by <a href="http://daux.io">Daux.io</a>
					</p>
				</div>
			</div>

			<div class="row-fluid columns content">
				<div class="left-column article-tree span3">
					<!-- For Mobile -->
					<div class="responsive-collapse">
						<button type="button" class="btn btn-sidebar" data-toggle="collapse" data-target="#sub-nav-collapse">
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					    </button>
					</div>
					<div id="sub-nav-collapse" class="collapse in">
						<!-- Navigation -->
						<? echo build_nav($tree); ?>

						<? if (!empty($options['links']) || !empty($options['twitter'])) { ?>
							<div class="well well-sidebar">
								<!-- Links -->
								<? foreach($options['links'] as $name => $url) { ?>
									<a href="<?=$url;?>" target="_blank"><?=$name;?></a><br>
								<? } ?>
								<!-- Twitter -->
								<? foreach($options['twitter'] as $handle) { ?>
									<div class="twitter">
												<hr/>
										<iframe allowtransparency="true" frameborder="0" scrolling="no" style="width:162px; height:20px;" src="https://platform.twitter.com/widgets/follow_button.html?screen_name=<?=$handle;?>&amp;show_count=false"></iframe>
									</div>
								<? } ?>
							</div>
						<? } ?>
					</div>
				</div>
				<div class="right-column <?=($options['float']?'float-view':''); ?> content-area span9">
					<div class="content-page">
						<article>
							<? echo load_page($tree); ?>
						</article>
					</div>
				</div>
			</div>
		</div>
	<? } ?>
</body>
</html>