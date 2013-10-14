<?php

/**
 * Style Guide All HTML elements.
 * Template Name: Style Guide - All HTML Elements
 *
 * @package MPH Starter
 * @since 0.1.6
 */

get_header();

have_posts();

the_post();

?>

<div class="row">

	<section class="primary-content grid-12">

		<article <?php post_class( array( 'entry' ) ); ?>>

			<header class="entry-header">

			    <h1 class="entry-title">Style Guide &ndash; Markup and Formatting</h1>

			</header>

			<div class="row">

				<div class="grid-8">

					<!-- Text -->
					<div>
				        <h2>Text Formatting</h2>

				        <h1>Header 1</h1>

				        <p>Paragraph - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras porttitor vestibulum leo, in interdum dui venenatis sed. Proin cursus ultricies fermentum. Aliquam id sapien at lectus auctor sodales.</p>

				        <h2>Header 2</h2>

				        <p>Paragraph - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras porttitor vestibulum leo, in interdum dui venenatis sed. Proin cursus ultricies fermentum. Aliquam id sapien at lectus auctor sodales.</p>

				        <h3>Header 3</h3>

				        <p>Paragraph - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras porttitor vestibulum leo, in interdum dui venenatis sed. Proin cursus ultricies fermentum. Aliquam id sapien at lectus auctor sodales.</p>

				        <h4>Header 4</h4>

				        <p>Paragraph - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras porttitor vestibulum leo, in interdum dui venenatis sed. Proin cursus ultricies fermentum. Aliquam id sapien at lectus auctor sodales.</p>

				        <h5>Header 5</h5>

				        <p>Paragraph - Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
				        
				        <h6>Header 6</h6>
				        
				        <p>Paragraph - Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
		        	</div>

		        	<hr />

					<!-- HTML Elements -->
		        	<div>
						<h2>HTML Elements</h2>
						<p>These supported tags come from the WordPress.com code <a title="Code" href="http://en.support.wordpress.com/code/">FAQ</a>.</p>
						<p><strong>Address Tag</strong></p>
						<address>1 Infinite Loop
							Cupertino, CA 95014
							United States
						</address>
						<p><strong>Anchor Tag (aka. Link)</strong> This is an example of a <a title="Apple" href="http://apple.com">link</a>.</p>
						<p><strong>Abbreviation Tag</strong> The abbreviation <abbr title="Seriously">srsly</abbr> stands for "seriously".</p>
						<p><strong>Acronym Tag</strong> The acronym <acronym title="For The Win">ftw</acronym> stands for "for the win".</p>
						<p><strong>Big Tag</strong> These tests are a <big>big</big> deal, but this tag is no longer supported in HTML5.</p>
						<p><strong>Cite Tag</strong> "Code is poetry." --<cite>Automattic</cite> </p>
						<p><strong>Code Tag</strong> You will learn later on in these tests that <code>word-wrap: break-word;</code> will be your best friend.</p>
						<p><strong>Delete Tag</strong> This tag will let you <del>strikeout text</del>, but this tag is no longer supported in HTML5 (use the <code>&lt;strike&gt;</code> instead).</p>
						<p><strong>Emphasize Tag</strong> The emphasize tag should <em>italicize</em> text.</p>
						<p><strong>Insert Tag</strong> This tag should denote <ins>inserted</ins> text.</p>
						<p><strong>Keyboard Tag</strong> This scarsly known tag emulates <kbd>keyboard text</kbd>, which is usually styled like the <code>&lt;code&gt;</code> tag.</p>
						<p><strong>Preformatted Tag</strong> This tag styles large blocks of code.</p>
						<pre>.post-title {
	margin: 0 0 5px;
	font-weight: bold;
	font-size: 38px;
	line-height: 1.2;
}</pre>
						<p><strong>Quote Tag</strong> <q>Developers, deveolpers, developers...</q> --Steve Ballmer</p>
						<p><strong>Strong Tag</strong> This tag shows <strong>bold<strong> text.</strong></strong></p>
						<p><strong>Subscript Tag</strong> Getting our science styling on with H<sub>2</sub>O, which should push the "2" down.</p>
						<p><strong>Superscript Tag</strong> Still sticking with science and Isaac Newton's E = MC<sup>2</sup>, which should lift the 2 up.</p>
						<p><strong>Teletype Tag</strong> This rarely used tag emulates <tt>teletype text</tt>, which is usually styled like the <code>&lt;code&gt;</code> tag.</p>
						<p><strong>Variable Tag</strong> This allows you to denote <var>variables</var>.</p>
					</div>

					<hr />

		        	<!-- Table Test -->
		        	<div>
				        <h2>Table Test</h2>
				        <table>

				        	<thead>
					            <tr>
					                <th>Table Heading</th>
					                <th>Table Heading</th>
					            </tr>
					        </thead>

				            <tbody>
				            <tr>
				                <td>Double Quotes</td>
				                <td>&ldquo;double quotes&rdquo;</td>
				            </tr>
				            <tr>
				                <td>Ampersand</td>
				                <td>&amp;</td>
				            </tr>
				            <tr>
				                <td>Copyright</td>
				                <td>&copy;</td>
				            </tr>
				            <tr>
				                <td>Trademark</td>
				                <td>&trade;</td>
				            </tr>
				            <tr>
				                <td>Registered Symbol</td>
				                <td>&reg;</td>
				            </tr>
				            <tr>
				                <td>Superscript 1,2,3</td>
				                <td>&sup1; &sup2; &sup3;</td>
				            </tr>

				            </tbody>

				        </table>
			        </div>

	        	</div>
		        
		        <div class="grid-4">
		        	
		        	<!-- Multi Line Headings -->
		        	<div>
			        	<h2>Multi Line Headings</h2>
				        <h1>Header 1 - Lorem ipsum&nbsp;dolor.</h1>
				        <h2>Header 2 - Lorem ipsum dolor sit&nbsp;amet.</h2>
				        <h3>Header 3 - Lorem ipsum dolor sit&nbsp;amet.</h3>
				        <h4>Header 4 - Lorem ipsum dolor sit amet, consectetur&nbsp;adipiscing.</h4>
				        <h5>Header 5 - Lorem ipsum dolor sit amet, consectetur adipiscing&nbsp;elit.</h5>
				        <h6>Header 6 - Lorem ipsum dolor sit amet, consectetur adipiscing&nbsp;elit.</h6>
		        	</div>

		        	<hr />

			        <!-- Lists -->
			        <div>
				        <h2>Lists</h2>

				        <p>Paragraph - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras porttitor vestibulum leo, in interdum dui venenatis sed. Proin cursus ultricies fermentum. Aliquam id sapien at lectus auctor sodales.</p>

				        <ul>
				            <li>Unordered list item</li>
				            <li>Unordered list item
						        <ul>
						            <li>Unordered list item</li>
						            <li>
						            	Unordered list item
										<ul>
											<li>Unordered list item</li>
											<li>Unordered list item</li>
										</ul>
						            </li>
						            <li>Unordered list item</li>
						        </ul>
				            </li>
				            <li>Unordered list item</li>
				        </ul>

				        <p>Paragraph - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras porttitor vestibulum leo, in interdum dui venenatis sed. Proin cursus ultricies fermentum. Aliquam id sapien at lectus auctor sodales.</p>

				        <ol>
							<li>Ordered list item</li>
							<li>Ordered list item
							    <ul>
							        <li>Ordered list item</li>
							        <li>
							        	Ordered list item
										<ul>
											<li>Ordered list item</li>
											<li>Ordered list item</li>
										</ul>
							        </li>
							        <li>Ordered list item</li>
							    </ul>
							</li>
							<li>Ordered list item</li>
				        </ol>

				        <p>Paragraph - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras porttitor vestibulum leo, in interdum dui venenatis sed. Proin cursus ultricies fermentum. Aliquam id sapien at lectus auctor sodales.</p>

						<dl>
							<dt>Definition List Title</dt>
							<dd>Definition list division.</dd>
							<dt>Lorem Ipsum</dt>
							<dd>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer&hellip;</dd>
						</dl>
					</div>

		        </div>
        
        	</div>

        <hr />

        <h2 class="prometheus-underline">Plugins</h2>

        <p>WP SEO Breadcrumbs</p>

        <p id="breadcrumbs"><span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb"><a href="#" rel="v:url" property="v:title">Home</a></span>   »   <span typeof="v:Breadcrumb"><a href="#" rel="v:url" property="v:title">Category</a></span>   »   <span typeof="v:Breadcrumb"><span class="breadcrumb_last" property="v:title">Page</span></span></span></p>

        <p>WP-Paginate</p>

            <ol class="wp-paginate">
                <li><a href="#" class="prev">&laquo;</a></li>
                <li><span class='page current'>1</span></li>
                <li><a href='#' title='2' class='page'>2</a></li>
                <li><a href='#' title='3' class='page'>3</a></li>
                <li><a href='#' title='4' class='page'>4</a></li>
                <li><a href='#' title='5' class='page'>5</a></li>
                <li><a href='#' title='6' class='page'>6</a></li>
                <li><a href="#" class="next">&raquo;</a></li>
            </ol>

        </div>

<!-- 
			<div class="entry-content">

				<p>A big page with every single HTML element. Everything should be styled and look nice.</p>

				<h1>Header one</h1>
				<h2>Header two</h2>
				<h3>Header three</h3>
				<h4>Header four</h4>
				<h5>Header five</h5>
				<h6>Header six</h6>
				<h2>Blockquotes</h2>
				Single line blockquote:
				<blockquote>Stay hungry. Stay foolish.</blockquote>
				Multi line blockquote with a cite reference:
				<blockquote>People think focus means saying yes to the thing you've got to focus on. But that's not what it means at all. It means saying no to the hundred other good ideas that there are. You have to pick carefully. I'm actually as proud of the things we haven't done as the things I have done. Innovation is saying no to 1,000 things. <cite>Steve Jobs - Apple Worldwide Developers' Conference, 1997</cite></blockquote>
				<h2>Tables</h2>
				<table>
					<tbody>
						<tr>
							<th>Employee</th>
							<th class="views">Salary</th>
							<th></th>
						</tr>
						<tr class="odd">
							<td><a href="http://john.do/">John Saddington</a></td>
							<td>$1</td>
							<td>Because that's all Steve Job' needed for a salary.</td>
						</tr>
						<tr class="even">
							<td><a href="http://tommcfarlin.com/">Tom McFarlin</a></td>
							<td>$100K</td>
							<td>For all the blogging he does.</td>
						</tr>
						<tr class="odd">
							<td><a href="http://jarederickson.com/">Jared Erickson</a></td>
							<td>$100M</td>
							<td>Pictures are worth a thousand words, right? So Tom x 1,000.</td>
						</tr>
						<tr class="even">
							<td><a href="http://chrisam.es/">Chris Ames</a></td>
							<td>$100B</td>
							<td>With hair like that?! Enough said...</td>
						</tr>
					</tbody>
				</table>

				<h2>Unordered Lists (Nested)</h2>
				<ul>
					<li>
						List item one
						<ul>
							<li>
								List item one
								<ul>
									<li>List item one</li>
									<li>List item two</li>
									<li>List item three</li>
									<li>List item four</li>
								</ul>
							</li>
							<li>List item two</li>
							<li>List item three</li>
							<li>List item four</li>
						</ul>
					</li>
					<li>List item two</li>
					<li>List item three</li>
					<li>List item four</li>
				</ul>
				<h2>Ordered List (Nested)</h2>
				<ol>
					<li>
						List item one
						<ol>
							<li>
								List item one
								<ol>
									<li>List item one</li>
									<li>List item two</li>
									<li>List item three</li>
									<li>List item four</li>
								</ol>
							</li>
							<li>List item two</li>
							<li>List item three</li>
							<li>List item four</li>
						</ol>
					</li>
					<li>List item two</li>
					<li>List item three</li>
					<li>List item four</li>
				</ol>

			</div> -->
		
		</article><!-- / .article -->

	</section><!-- / .primary-content -->

</div>

<?php get_footer(); ?>