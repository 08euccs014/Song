																<div class=" jpp-doc-content text-justify"><h1 class="span8 text-right custom-doc-version-filter"></h1>
             
<header>
    <h1 role="title">Jreview</h1>
    <p>Jreview component is tool used for submit entries by different user and user can also add images, attachments, video and audio with an entry. after that user can also publish and delete these entries. so this is very useful for a item selling site ,traveling place site etc.</p>
</header>

<article>

<div><p>This app will provide you:</p>
<div>

<ol>

<li>Restricts user to limit following no. of posting in different categories.
      <ul>
       <li>listings</li>
       <li>Images</li>
       <li>Attachments</li>
       <li>audio</li>
       <li>video</li> 
      </ul>
</li>


<li>Overall restriction is also possible whatever category user choose to post listings.</li>

<li>With the listing user can also submit images so same above policies can applied on images also.</li>

<li>With this app, a dashboard widget also include so that user can easily cross check that how much listing he/she posted, and how much he/she will be allowed.</li>

</ol>

</div>



<p><b>Guide to use:</b></p>


<p><b>Step 1:</b> firstly you need to create these categories in joomla, e.g.</p>


<ul>

<li>test category 1</li>

<li>test category 2</li>

<li>test category 3</li>

</ul>


<p>then you need to simply map them to listing in jreview as follows:</p>
<figure>
	<img title="jreview with payplans" alt="jreview with payplans" src="http://pub.jpayplans.com/livesite/screenshots/docs/integration/jreview/payplans_jreview_backend_screen_1.png">
	<figcaption class="img-caption">create categories in jreview</figcaption>
</figure>
</div>


<p><b>Step 2:</b>  next you need to create an jreview app instance and configure it as follows:</p>


<p><b>A CASE STUDY:</b> Let ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¹Ã…â€œs say you need to restrict user to post not more than 2 listing  and 2 images and 1 attachment in test category 1 on purchasing of Bonus plan , then you need to set certain parameter as follows:</p> 


<div>

<table>
<tbody>

<tr>

<td>Apply on selected plans
</td>

<td>:
</td>

<td>Bonus Plan
</td>

</tr>

<tr>

<td>apply on
</td>

<td>:
</td>

<td>specific category
</td>

</tr>

<tr>
<td>Select Category
</td>

<td>:
</td>
<td>test category 1</td>
</tr>

</tbody>

</table>
</div>


<div class="docs-screen">
	<figure>
		<img title="jreview with payplans" alt="create app instance" src="http://pub.jpayplans.com/livesite/screenshots/docs/integration/jreview/payplans_jreview_backend_screen_2.png" >
		<figcaption class="img-caption">create app instance </figcaption>
        </figure>
</div>

<p>and in second scenario if you also want to restrict user to post overall only 2 listing but it does not restrict on number of images on purchasing of forever free plan, then you need to set another instance of app as follows:</p>

<table>
<tbody>

<tr>

<td>Apply on selected plans
</td>

<td>:
</td>

<td>Forever Free Plan
</td>

</tr>

<tr>

<td>apply on
</td>

<td>:
</td>

<td>any category
</td>

</tr>


</tbody>

</table>


<p><b>Note #</b> If you will leave any no. of listing field blank that means it will not restrict at all.</p>

<figure>
<img title="jreview with payplans" alt="create app instance " src="http://pub.jpayplans.com/livesite/screenshots/docs/integration/jreview/payplans_jreview_backend_screen_3.png">
		<figcaption class="img-caption">create app instance </figcaption>
        </figure>


<p><b>Step 3:</b>  Now you can also create dashboard widget for jreview app.</p>

<p><b>Step 4:</b> Now from frontend user purchase a bonus plan then he/she allowed to post specified credential to that user.</p>


<figure>
<img title="payplans integration with jreview" alt="choose plans" src="http://pub.jpayplans.com/livesite/screenshots/docs/integration/jreview/payplans_jreview_frontend_screen_1.png">
		<figcaption class="img-caption">choose plan</figcaption>
        </figure>

<p><b>Step 5:</b> Now go to dashboard user can also see his/her credits about jreview.</p>

<figure>
<img title="jreview with payplans" alt="dashboard widget" src="http://pub.jpayplans.com/livesite/screenshots/docs/integration/jreview/payplans_jreview_frontend_screen_2.png">
		<figcaption class="img-caption">dashboard widget</figcaption>
        </figure>
<p><b>Step 6:</b> Next try to submit a listing in jreview.</p>


<div class="docs-screen">
	<figure>
		<img title="jreview with payplans" alt="submite review" src="http://pub.jpayplans.com/livesite/screenshots/docs/integration/jreview/payplans_jreview_frontend_screen_3.png">
		<figcaption class="img-caption">submite review</figcaption>
        </figure>
</div>

<p><b>Step 7:</b> He/She will be restricted because if there is an instance of any category app then then he/she need to subscribe that plan also other wise he/will be restricted.</p>

	<figure>
<img title="jreview with payplans" alt="limitation message" src="http://pub.jpayplans.com/livesite/screenshots/docs/integration/jreview/payplans_jreview_frontend_screen_4.png">
		<figcaption class="img-caption">limitation message</figcaption>
        </figure>

<p><b>Step 8:</b> If user will subscribe second forever free plans then he/she will be allowed to post listing.</p>


	<figure>
<img  title="payplans jreview app" alt="dashboard widget" src="http://pub.jpayplans.com/livesite/screenshots/docs/integration/jreview/payplans_jreview_frontend_screen_5.png" >
		<figcaption class="img-caption">dashboard widget</figcaption>
        </figure>
<p><b>Step 9:</b> Now, he can post listings in jreview successfully.</p>

	<figure>
		<img title="payplans jreview app" alt="submite reviwe" src="http://pub.jpayplans.com/livesite/screenshots/docs/integration/jreview/payplans_jreview_frontend_screen_6.png">
		<figcaption class="img-caption">submite review</figcaption>
        </figure>


<p><b>Step 10:</b>if user submit some images here by clicking select files then he/allows to submit only two images not more than that, if he does that then submission will be restricted.</p>
	<figure>

<img title="payplans jreview app" alt="dashboard widget" src="http://pub.jpayplans.com/livesite/screenshots/docs/integration/jreview/payplans_jreview_frontend_screen_7.png">
		<figcaption class="img-caption">dashboard widget</figcaption>
        </figure>

<p><b>Step 11:</b>In dashboard user can also how much his/her listing are consumed and remaining.</p>

	<figure>

<img title="payplans jreview app" alt="dashboard widget" src="http://pub.jpayplans.com/livesite/screenshots/docs/integration/jreview/payplans_jreview_frontend_screen_8.png">
		<figcaption class="img-caption">dashboard widget</figcaption>
        </figure>
<p>as you can see user can post atmost 2 listing in test category1 even he/she will allowed to post 3 in any category but he/she will be restricted according to settled configuration.</p>

<p><b>Step 12:</b>Now if user want to submit his 1 allowed attachment then, he goes to edit his posted listing then click to add media, then he/she can attach it.</p>
	<figure>

<img title="payplans jreview app" alt="dashboard widget" src="http://pub.jpayplans.com/livesite/screenshots/docs/integration/jreview/payplans_jreview_frontend_screen_9.png">
		<figcaption class="img-caption">dashboard widget</figcaption>
        </figure>
<p>if user want to add one more then he/she will be restricted to add more.</p>





<p>So this app is very useful to admin, it empowers to restricts users according to plans like silver, gold etc. to limit there no. postings, images, attachment, video and audio.</p>





</div></div></div>
</article>

        </div>								