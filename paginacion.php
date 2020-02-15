<head>

<link rel="stylesheet" href="CSS/paginacion.css" >

</head>

<h1>How to style the TYPO3 Pagination Widget</h1>
<p class="lead">The widget <code>&lt;f:widget.paginate&gt;</code> in the templating framework Fluid can be easily styled with a little clever CSS. Even without changing the HTML output. Here is an example, which I use for numerous projects. Take a look at the code to learn from it, or apply it to your own projects. <strong><i>This code is also available on <a href="https://github.com/koehlersimon/typo3-pagination-styles">GitHub</a>!</i></strong></p>

<h2>Basic Example</h2>
<ul class="f3-widget-paginator">
  <li class="previous">
    <a rel="prev" href="#">previous</a></li>
  <li>
    <a href="#">1</a></li>
  <li class="current">
    2
  </li>
  <li>
    <a href="#">3</a>
  </li>
  <li>
    <a href="#">4</a>
  </li>
  <li>
    <a href="#">5</a>
  </li>
  <li>
    <a href="#">6</a>
  </li>
  <li class="next">
    <a rel="next" href="#">next</a>
  </li>
</ul>
<p></p>

<h2>Align center</h2>
<div class="example-centered">
  <ul class="f3-widget-paginator">
    <li class="previous">				
      <a rel="prev" href="#">previous</a>
    </li>
    <li>
      <a href="#">1</a>
    </li>
    <li class="current">
      2
    </li>
    <li>
      <a href="#">3</a>
    </li>
    <li>
      <a href="#">4</a>
    </li>
    <li>
      <a href="#">5</a>
    </li>
    <li>
      <a href="#">6</a>
    </li>
    <li class="next">
      <a rel="next" href="#">next</a>
    </li>
  </ul>
</div>

<h2>Align right</h2>
<div class="example-right">
  <ul class="f3-widget-paginator">
    <li class="previous">				
      <a rel="prev" href="#">previous</a>
    </li>
    <li>
      <a href="#">1</a>
    </li>
    <li class="current">
      2
    </li>
    <li>
      <a href="#">3</a>
    </li>
    <li>
      <a href="#">4</a>
    </li>
    <li>
      <a href="#">5</a>
    </li>
    <li>
      <a href="#">6</a>
    </li>
    <li class="next">
      <a rel="next" href="#">next</a>
    </li>
  </ul>
</div>

<h2>More about TYPO3 the Pagination ViewHelper</h2>
<a href="https://docs.typo3.org/other/typo3/view-helper-reference/9.5/en-us/typo3/fluid/latest/Widget/Paginate.html" target="_blank">https://docs.typo3.org/other/typo3/view-helper-reference/9.5/en-us/typo3/fluid/latest/Widget/Paginate.html</a>