<?php
// Ratatouille Fox — homepage
function e($s) { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
$themes = [
  1 => ['Meat-free Monday', 'Start the week with a vegetable-packed bake or a big pot of bean soup.', 'Try the bean & vegetable soup'],
  2 => ['Pasta Tuesday', 'Quick, comforting and endlessly flexible: toss pasta with whatever vegetables need using up.', 'Try the tomato & basil pesto pasta'],
  3 => ['One-pan Wednesday', 'Midweek calls for fewer dishes. Everything goes in one skillet or roasting tray.', 'Try the one-pan skillet supper'],
  4 => ['Bowl Thursday', 'Grains, roasted vegetables and a bright dressing make a light, colourful dinner.', 'Try the roasted vegetable grain bowl'],
  5 => ['Fish Friday', 'Roast a fillet on a bed of thin potatoes and vegetables with lemon and herbs.', 'Try the lemon & herb roasted fish'],
  6 => ['Slow-cook Saturday', 'More time on your hands? Let a ratatouille or roast take its time in the oven.', 'Try the signature ratatouille'],
  7 => ['Sunday Roast', 'Gather everyone around herb-roasted chicken and a tray of seasonal vegetables.', 'Try the herb-roasted drumsticks'],
];
$dow = (int) date('N');
$theme = $themes[$dow];
$m = (int) date('n');
$produce = [
  'winter' => ['Winter', ['Leeks', 'Cabbage', 'Carrots', 'Parsnips', 'Kale', 'Citrus']],
  'spring' => ['Spring', ['Asparagus', 'Peas', 'Spring onions', 'Radishes', 'Spinach', 'New potatoes']],
  'summer' => ['Summer', ['Courgettes', 'Aubergines', 'Tomatoes', 'Peppers', 'Basil', 'Sweetcorn']],
  'autumn' => ['Autumn', ['Squash', 'Mushrooms', 'Late tomatoes', 'Peppers', 'Apples', 'Beetroot']],
];
$key = in_array($m, [12, 1, 2]) ? 'winter' : (in_array($m, [3, 4, 5]) ? 'spring' : (in_array($m, [6, 7, 8]) ? 'summer' : 'autumn'));
$season = $produce[$key];
$msg = ''; $ok = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nl_email'])) {
    $email = trim((string) filter_input(INPUT_POST, 'nl_email', FILTER_SANITIZE_EMAIL));
    if (!empty($_POST['website'])) { $ok = true; $msg = 'Thank you.'; }
    elseif ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        @file_put_contents(__DIR__ . '/subscribers.txt', date('c') . "\t" . $email . PHP_EOL, FILE_APPEND | LOCK_EX);
        $ok = true; $msg = 'Lovely! Your first Fox Supper Club email arrives on Sunday.';
    } else { $msg = 'Please enter a valid email address.'; }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ratatouille Fox | Easy Dinner Recipes &amp; Provençal Ratatouille</title>
<meta name="description" content="Vegetable-forward dinner recipes inspired by Provence: a signature ratatouille with a servings scaler, a dinner planner, seasonal produce and simple kitchen tips.">
<meta name="robots" content="index, follow, max-image-preview:large">
<link rel="canonical" href="https://www.ratatouillefox.com/">
<meta property="og:type" content="website"><meta property="og:site_name" content="Ratatouille Fox">
<meta property="og:title" content="Ratatouille Fox | Easy Dinner Recipes &amp; Provençal Ratatouille"><meta property="og:description" content="Vegetable-forward dinner recipes inspired by Provence: a signature ratatouille with a servings scaler, a dinner planner, seasonal produce and simple kitchen tips.">
<meta property="og:url" content="https://www.ratatouillefox.com/"><meta property="og:image" content="https://images.unsplash.com/photo-1652622550740-f90d03edfbf0?auto=format&fit=crop&w=1200&q=75">
<meta name="twitter:card" content="summary_large_image"><meta name="theme-color" content="#3D2645">
<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 44 44'%3E%3Ccircle cx='22' cy='22' r='21' fill='%233D2645'/%3E%3Cpath d='M10 12l6 9h12l6-9-2 13c0 6-5 11-10 11s-10-5-10-11Z' fill='%23D1462F'/%3E%3C/svg%3E">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link rel="preconnect" href="https://images.unsplash.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,600&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0LY0HY7L01"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-0LY0HY7L01');
</script>
<script type="application/ld+json">[{"@context": "https://schema.org", "@type": "Organization", "name": "Ratatouille Fox", "url": "https://www.ratatouillefox.com/", "email": "hello@ratatouillefox.com", "telephone": "+1-888-777-5845", "address": {"@type": "PostalAddress", "streetAddress": "181 Mercer Street", "addressLocality": "New York", "addressRegion": "NY", "postalCode": "10012", "addressCountry": "US"}}, {"@context": "https://schema.org", "@type": "FAQPage", "mainEntity": [{"@type": "Question", "name": "What is ratatouille?", "acceptedAnswer": {"@type": "Answer", "text": "Ratatouille is a classic Provençal vegetable dish from the south of France, made with aubergine, courgette, peppers, tomatoes, onion and garlic cooked in olive oil with herbs. It can be a rustic stew or neatly layered slices baked in the oven."}}, {"@type": "Question", "name": "Can I make ratatouille ahead of time?", "acceptedAnswer": {"@type": "Answer", "text": "Yes. Like many stews, it often tastes better the next day once the flavours have mingled. Cool it quickly, refrigerate in a covered container and eat within three to four days, reheating until piping hot."}}, {"@type": "Question", "name": "What do you serve with ratatouille?", "acceptedAnswer": {"@type": "Answer", "text": "Serve it with crusty bread, polenta, rice or pasta for a vegetarian main, or alongside roast chicken, fish or grilled lamb. A spoonful of goat’s cheese or a fried egg on top is also delicious."}}, {"@type": "Question", "name": "How do I stop vegetables turning mushy?", "acceptedAnswer": {"@type": "Answer", "text": "Cut them evenly, avoid overcrowding the pan and cook the firmer vegetables first. For layered versions, slice thinly and bake uncovered for the final stage so excess liquid evaporates."}}, {"@type": "Question", "name": "Are the recipes suitable for vegetarians?", "acceptedAnswer": {"@type": "Answer", "text": "Many of our recipes are vegetarian, and we label each one clearly. Always check ingredient labels for hidden animal products, such as cheeses made with animal rennet."}}, {"@type": "Question", "name": "Is Ratatouille Fox a restaurant?", "acceptedAnswer": {"@type": "Answer", "text": "No. Ratatouille Fox is an independent home-cooking website. We share recipes and kitchen guidance; we do not operate a restaurant, sell food or take orders."}}]}, {"@context": "https://schema.org", "@type": "Recipe", "name": "Slow-Baked Provençal Ratatouille", "author": {"@type": "Organization", "name": "Ratatouille Fox"}, "image": "https://images.unsplash.com/photo-1785703285213-c15cbb8a286e?auto=format&fit=crop&w=1200&q=75", "description": "A layered Provençal vegetable bake with aubergine, courgette, pepper and tomato over a garlicky tomato base.", "recipeYield": "4 servings", "prepTime": "PT25M", "cookTime": "PT65M", "totalTime": "PT90M", "recipeCategory": "Dinner", "recipeCuisine": "French", "keywords": "ratatouille, vegetarian dinner, Provençal", "recipeIngredient": ["1 medium aubergine, thinly sliced", "2 courgettes, thinly sliced", "1 yellow pepper, cut into strips", "6 ripe plum tomatoes, thinly sliced", "1 onion, finely chopped", "3 garlic cloves, crushed", "400 g canned chopped tomatoes for the base", "4 tbsp olive oil", "1 tsp dried thyme or herbes de Provence", "2 tbsp fresh basil, torn"], "recipeInstructions": [{"@type": "HowToStep", "text": "Heat the oven to 180°C (350°F). Soften the onion in 2 tbsp olive oil for 8 minutes, add the garlic and cook for 1 minute."}, {"@type": "HowToStep", "text": "Stir in the chopped tomatoes and thyme, season and simmer for 10 minutes. Spread over the base of a round baking dish."}, {"@type": "HowToStep", "text": "Arrange the sliced vegetables in overlapping, alternating rows or a spiral over the sauce."}, {"@type": "HowToStep", "text": "Drizzle with the remaining olive oil, season, cover with baking paper and bake for 45 minutes."}, {"@type": "HowToStep", "text": "Uncover and bake for 20 more minutes until tender and lightly golden. Scatter with basil and rest for 10 minutes before serving."}]}]</script>
</head>
<body>
<a class="skip" href="#main">Skip to content</a>
<div class="stripe" aria-hidden="true"></div>
<header class="hdr">
  <div class="wrap">
    <a class="logo" href="index.php" aria-label="Ratatouille Fox home"><svg viewBox="0 0 44 44" aria-hidden="true"><circle cx="22" cy="22" r="21" fill="#3D2645"/><path d="M10 12l6 9h12l6-9-2 13c0 6-5 11-10 11s-10-5-10-11Z" fill="#D1462F"/><path d="M16 27c2 4 4 6 6 6s4-2 6-6c-2 1-4 1.5-6 1.5S18 28 16 27Z" fill="#FBF5EA"/><circle cx="18" cy="24" r="1.6" fill="#28182E"/><circle cx="26" cy="24" r="1.6" fill="#28182E"/><circle cx="22" cy="30" r="1.4" fill="#28182E"/></svg><span>Ratatouille <em>Fox</em></span></a>
    <nav id="nav" aria-label="Main navigation"><ul class="nav"><li><a href="index.php" aria-current="page">Home</a></li><li><a href="dinner-recipes.html">Dinner Recipes</a></li><li><a href="kitchen-guide.html">Kitchen Guide</a></li><li><a href="about.html">About</a></li><li><a href="contact.html">Contact</a></li></ul></nav>
    <button class="burger" aria-label="Open menu" aria-expanded="false" aria-controls="nav"><span></span><span></span><span></span></button>
  </div>
</header>
<main id="main">
<section class="hero">
  <div class="wrap">
    <div class="hero-grid">
      <div>
        <span class="eyebrow">Vegetable-forward dinners</span>
        <h1>Colourful dinners, <i>layered</i> with flavour.</h1>
        <p class="lead">Ratatouille Fox shares relaxed, home-tested dinner recipes inspired by the sunny kitchens of Provence, plus planning tips and techniques that make cooking every evening feel easy.</p>
        <div class="ctas"><a class="btn" href="#planner-sec">Plan tonight&#8217;s dinner</a><a class="btn btn--line" href="dinner-recipes.html">Browse recipes</a></div>
      </div>
      <div class="plate">
        <div class="ring" aria-hidden="true"></div>
        <div class="dish"><img src="https://images.unsplash.com/photo-1652622550740-f90d03edfbf0?auto=format&fit=crop&w=900&q=75" alt="pan filled with sliced vegetables arranged in layers" width="900" height="900" fetchpriority="high"></div>
        <div class="side"><img src="https://images.unsplash.com/photo-1757521853906-a83f78702962?auto=format&fit=crop&w=400&q=75" alt="striped aubergine on a dark background" width="400" height="400"></div>
        <div class="tag">Five vegetables,<br>one beautiful pan</div>
      </div>
    </div>
    <div class="tonight" aria-live="polite">
      <div class="day"><small>TONIGHT</small><span><?php echo e(date('l')); ?></span></div>
      <div><h2><?php echo e($theme[0]); ?></h2><p><?php echo e($theme[1]); ?></p></div>
      <a class="btn" href="dinner-recipes.html"><?php echo e($theme[2]); ?></a>
    </div>
  </div>
</section>

<section class="sec paper" aria-labelledby="ly-t">
  <div class="wrap">
    <div class="sec-head"><span class="eyebrow g">The five layers</span><h2 id="ly-t">What makes a great ratatouille</h2><p class="muted">Every vegetable plays its part. Choose ripe, firm produce, cut it evenly and give each one a little space to caramelise.</p></div>
    <div class="layers"><article class="veg"><div class="pic"><img src="https://images.unsplash.com/photo-1639428134238-b548770d4b77?auto=format&fit=crop&w=500&q=75" alt="a purple aubergine on a wooden surface with leaves" width="500" height="500" loading="lazy"></div><div class="t"><span style="background:#3D2645">1</span><h3>Aubergine</h3><p>Silky when slow-cooked; salt thick slices first if they taste bitter.</p></div></article><article class="veg"><div class="pic"><img src="https://images.unsplash.com/photo-1615484477545-04af2a4d851c?auto=format&fit=crop&w=500&q=75" alt="sliced green courgette on a white surface" width="500" height="500" loading="lazy"></div><div class="t"><span style="background:#5B7B3A">2</span><h3>Courgette</h3><p>Adds freshness; cut evenly so it softens without turning watery.</p></div></article><article class="veg"><div class="pic"><img src="https://images.unsplash.com/photo-1563565375-f3fdfdbefa83?auto=format&fit=crop&w=500&q=75" alt="four peppers in different colours" width="500" height="500" loading="lazy"></div><div class="t"><span style="background:#E3A02B">3</span><h3>Peppers</h3><p>Red and yellow peppers bring sweetness and colour.</p></div></article><article class="veg"><div class="pic"><img src="https://images.unsplash.com/photo-1571680322317-a5f004900ace?auto=format&fit=crop&w=500&q=75" alt="three red tomatoes" width="500" height="500" loading="lazy"></div><div class="t"><span style="background:#D1462F">4</span><h3>Tomatoes</h3><p>Ripe tomatoes form the saucy heart of the dish.</p></div></article><article class="veg"><div class="pic"><img src="https://images.unsplash.com/photo-1585849834908-3481231155e8?auto=format&fit=crop&w=500&q=75" alt="pink and white garlic bulbs on a white surface" width="500" height="500" loading="lazy"></div><div class="t"><span style="background:#9A7A5A">5</span><h3>Garlic &amp; onion</h3><p>Gently softened, they build the savoury base.</p></div></article></div>
  </div>
</section>

<section class="sec" id="planner-sec" aria-labelledby="pl-t">
  <div class="wrap">
    <div class="sec-head"><span class="eyebrow">Dinner planner</span><h2 id="pl-t">What should we cook tonight?</h2><p class="muted">Tell us how much time you have, what you eat and the kind of dinner you&#8217;re in the mood for. We&#8217;ll suggest an idea from our recipe collection.</p></div>
    <div class="planner">
      <form id="planner" onsubmit="return false">
        <fieldset class="fld"><legend>Time available</legend><div class="chips">
          <label><input type="radio" name="time" value="quick"><span>Under 30 min</span></label><label><input type="radio" name="time" value="medium"><span>30&ndash;60 min</span></label><label><input type="radio" name="time" value="slow" checked><span>I have time</span></label></div></fieldset>
        <fieldset class="fld"><legend>Diet</legend><div class="chips">
          <label><input type="radio" name="diet" value="veg" checked><span>Vegetarian</span></label><label><input type="radio" name="diet" value="any"><span>Anything goes</span></label></div></fieldset>
        <fieldset class="fld" style="margin:0"><legend>Mood</legend><div class="chips">
          <label><input type="radio" name="mood" value="light" checked><span>Light &amp; fresh</span></label><label><input type="radio" name="mood" value="comfort"><span>Cosy &amp; comforting</span></label></div></fieldset>
      </form>
      <div class="res" aria-live="polite">
        <div class="pic"><img data-dish="pasta" src="https://images.unsplash.com/photo-1473093295043-cdd812d0e601?auto=format&fit=crop&w=800&q=75" alt="pesto pasta with sliced tomatoes on a white plate" width="800" height="450" loading="lazy" hidden><img data-dish="salad" src="https://images.unsplash.com/photo-1623428187969-5da2dcea5ebf?auto=format&fit=crop&w=800&q=75" alt="blue bowl filled with fresh vegetables" width="800" height="450" loading="lazy" hidden><img data-dish="soup" src="https://images.unsplash.com/photo-1512003867696-6d5ce6835040?auto=format&fit=crop&w=800&q=75" alt="vegetable soup with beans in a bowl" width="800" height="450" loading="lazy" hidden><img data-dish="fish" src="https://images.unsplash.com/photo-1773417461034-75e751de40ba?auto=format&fit=crop&w=800&q=75" alt="whole roasted fish with lemon slices and grilled vegetables" width="800" height="450" loading="lazy" hidden><img data-dish="chicken" src="https://images.unsplash.com/photo-1764756995069-4a0b5f31d792?auto=format&fit=crop&w=800&q=75" alt="roasted chicken drumsticks in a glass baking dish" width="800" height="450" loading="lazy" hidden><img data-dish="skillet" src="https://images.unsplash.com/photo-1606374894242-19110fdbd56c?auto=format&fit=crop&w=800&q=75" alt="cooked food in a black skillet" width="800" height="450" loading="lazy" hidden><img data-dish="rata" src="https://images.unsplash.com/photo-1630173314503-544080d4dee7?auto=format&fit=crop&w=800&q=75" alt="plate of cooked vegetables" width="800" height="450" loading="lazy"></div>
        <div class="t"><span class="eyebrow" style="color:var(--sun)">Tonight&#8217;s idea</span><h3 id="p-name">Slow-baked Proven&ccedil;al ratatouille</h3><div class="meta" id="p-meta"><span>1 hr 30 min</span><span>Vegetarian</span><span>Serves 4</span></div><p id="p-desc">Layer thin slices of aubergine, courgette, tomato and pepper over a garlicky tomato base and bake slowly until meltingly tender.</p><a class="btn" href="dinner-recipes.html" style="background:var(--sun);color:var(--aub-dk)">See all recipes</a></div>
      </div>
    </div>
  </div>
</section>

<section class="sec paper" id="recipe" aria-labelledby="rc-t">
  <div class="wrap recipe">
    <div>
      <span class="eyebrow">Signature recipe</span>
      <h2 id="rc-t">Slow-baked Proven&ccedil;al ratatouille</h2>
      <p class="muted">Prep 25 min &middot; Cook 1 hr 5 min &middot; Vegetarian &middot; Naturally gluten-free</p>
      <div class="pic"><img src="https://images.unsplash.com/photo-1785703285213-c15cbb8a286e?auto=format&fit=crop&w=900&q=75" alt="preparing ratatouille with olive oil and fresh herbs" width="900" height="675" loading="lazy"></div>
      <ol class="steps"><li><p>Heat the oven to 180&deg;C (350&deg;F). Soften the onion in 2 tbsp olive oil for 8 minutes, add the garlic and cook for 1 minute.</p></li><li><p>Stir in the chopped tomatoes and thyme, season and simmer for 10 minutes. Spread over the base of a round baking dish.</p></li><li><p>Arrange the sliced vegetables in overlapping, alternating rows or a spiral over the sauce.</p></li><li><p>Drizzle with the remaining olive oil, season, cover with baking paper and bake for 45 minutes.</p></li><li><p>Uncover and bake for 20 more minutes until tender and lightly golden. Scatter with basil and rest for 10 minutes before serving.</p></li></ol>
    </div>
    <div class="rcard">
      <h3>Ingredients</h3>
      <div class="serv" role="group" aria-label="Adjust servings"><button type="button" data-sv="-1" aria-label="Fewer servings">&minus;</button><output id="srv" aria-live="polite">4 servings</output><button type="button" data-sv="1" aria-label="More servings">+</button></div>
      <ul class="ing"><li><span>medium aubergine, thinly sliced</span><b data-q="1" data-u="" data-int="1">1</b></li><li><span>courgettes, thinly sliced</span><b data-q="2" data-u="" data-int="1">2</b></li><li><span>yellow pepper, cut into strips</span><b data-q="1" data-u="" data-int="1">1</b></li><li><span>ripe plum tomatoes, thinly sliced</span><b data-q="6" data-u="" data-int="1">6</b></li><li><span>onion, finely chopped</span><b data-q="1" data-u="" data-int="1">1</b></li><li><span>garlic cloves, crushed</span><b data-q="3" data-u="" data-int="1">3</b></li><li><span>canned chopped tomatoes for the base</span><b data-q="400" data-u="g" data-int="1">400 g</b></li><li><span>olive oil</span><b data-q="4" data-u="tbsp">4 tbsp</b></li><li><span>dried thyme or herbes de Provence</span><b data-q="1" data-u="tsp">1 tsp</b></li><li><span>fresh basil, torn</span><b data-q="2" data-u="tbsp">2 tbsp</b></li></ul>
      <p class="small muted" style="margin-top:16px">Quantities are rounded for easy cooking. Season with salt and black pepper to taste. Use a larger dish or two dishes when cooking for more than six.</p>
    </div>
  </div>
</section>

<section class="sec" aria-labelledby="se-t">
  <div class="wrap season">
    <div class="pic"><img src="https://images.unsplash.com/photo-1702506183879-398318b92f6d?auto=format&fit=crop&w=800&q=75" alt="variety of fresh vegetables on display at a market" width="800" height="660" loading="lazy"></div>
    <div>
      <span class="eyebrow g">Cook with the season</span>
      <h2 id="se-t">In season this <?php echo e($season[0]); ?></h2>
      <p>Seasonal produce is usually at its most flavourful and best value. Here&#8217;s what to look out for at markets and greengrocers right now:</p>
      <div class="produce"><?php foreach ($season[1] as $p): ?><span><?php echo e($p); ?></span><?php endforeach; ?></div>
      <p class="muted small">Suggestions are for temperate Northern Hemisphere climates and update automatically through the year.</p>
      <a class="btn btn--aub" href="kitchen-guide.html">Seasonal cooking tips</a>
    </div>
  </div>
</section>

<section class="band" aria-labelledby="tb-t">
  <img src="https://images.unsplash.com/photo-1562050344-f7ad946cee35?auto=format&fit=crop&w=1800&q=75" alt="long dining table set with white plates and candles" width="1800" height="1200" loading="lazy">
  <div class="wrap">
    <span class="eyebrow" style="color:var(--sun)">At the table</span>
    <h2 id="tb-t">Dinner is more than what&#8217;s on the plate</h2>
    <p>Some of our favourite evenings are the simplest: one big dish in the middle of the table, good bread and time to talk. A few small rituals make any weeknight feel special.</p>
    <div class="tips">
      <div><b>Serve family-style</b>Bring the pan to the table and let everyone help themselves.</div>
      <div><b>Light a candle</b>Soft light slows the pace and signals the end of the working day.</div>
      <div><b>Phones away</b>Give the meal and the conversation your full attention.</div>
    </div>
  </div>
</section>

<section class="sec" aria-labelledby="fq-t">
  <div class="wrap faq-grid">
    <div><span class="eyebrow">Questions</span><h2 id="fq-t">Your dinner questions</h2><p class="muted">Stuck on a recipe or a technique? Send us a note and we&#8217;ll do our best to help.</p><a class="btn btn--aub" href="contact.html">Ask the kitchen</a><div class="pic"><img src="https://images.unsplash.com/photo-1598295309854-cfa5819004d8?auto=format&fit=crop&w=800&q=75" alt="sliced green and red peppers on a white chopping board" width="800" height="660" loading="lazy"></div></div>
    <div><details open><summary>What is ratatouille?</summary><p>Ratatouille is a classic Provençal vegetable dish from the south of France, made with aubergine, courgette, peppers, tomatoes, onion and garlic cooked in olive oil with herbs. It can be a rustic stew or neatly layered slices baked in the oven.</p></details><details><summary>Can I make ratatouille ahead of time?</summary><p>Yes. Like many stews, it often tastes better the next day once the flavours have mingled. Cool it quickly, refrigerate in a covered container and eat within three to four days, reheating until piping hot.</p></details><details><summary>What do you serve with ratatouille?</summary><p>Serve it with crusty bread, polenta, rice or pasta for a vegetarian main, or alongside roast chicken, fish or grilled lamb. A spoonful of goat&#8217;s cheese or a fried egg on top is also delicious.</p></details><details><summary>How do I stop vegetables turning mushy?</summary><p>Cut them evenly, avoid overcrowding the pan and cook the firmer vegetables first. For layered versions, slice thinly and bake uncovered for the final stage so excess liquid evaporates.</p></details><details><summary>Are the recipes suitable for vegetarians?</summary><p>Many of our recipes are vegetarian, and we label each one clearly. Always check ingredient labels for hidden animal products, such as cheeses made with animal rennet.</p></details><details><summary>Is Ratatouille Fox a restaurant?</summary><p>No. Ratatouille Fox is an independent home-cooking website. We share recipes and kitchen guidance; we do not operate a restaurant, sell food or take orders.</p></details></div>
  </div>
</section>

<section class="sec" style="padding-top:0" id="club" aria-labelledby="nl-t">
  <div class="wrap">
    <div class="nl">
      <div class="in">
        <span class="eyebrow" style="color:#fff">Every Sunday</span>
        <h2 id="nl-t">The Fox Supper Club</h2>
        <p>One friendly email each week with three dinner ideas, a seasonal ingredient to try and a handy kitchen tip. No spam, unsubscribe any time.</p>
        <?php if ($msg): ?><p class="<?php echo $ok ? 'ok' : 'err'; ?>" role="status"><?php echo e($msg); ?></p><?php endif; ?>
        <form method="post" action="index.php#club">
          <label for="ne" class="skip">Email address</label>
          <input type="email" id="ne" name="nl_email" placeholder="Your email address" required autocomplete="email">
          <input type="text" name="website" tabindex="-1" autocomplete="off" style="display:none" aria-hidden="true">
          <button class="btn" type="submit">Join the club</button>
        </form>
        <p class="small">Read our <a href="privacy-policy.html">Privacy Policy</a>.</p>
      </div>
      <div class="pic"><img src="https://images.unsplash.com/photo-1600759487717-62bbb608106e?auto=format&fit=crop&w=900&q=75" alt="rows of purple lavender in a field in Provence" width="900" height="700" loading="lazy"></div>
    </div>
  </div>
</section>
</main>
<footer class="ftr">
  <div class="wrap">
    <div class="ftr-grid">
      <div><a class="logo" href="index.php"><svg viewBox="0 0 44 44" aria-hidden="true"><circle cx="22" cy="22" r="21" fill="#3D2645"/><path d="M10 12l6 9h12l6-9-2 13c0 6-5 11-10 11s-10-5-10-11Z" fill="#D1462F"/><path d="M16 27c2 4 4 6 6 6s4-2 6-6c-2 1-4 1.5-6 1.5S18 28 16 27Z" fill="#FBF5EA"/><circle cx="18" cy="24" r="1.6" fill="#28182E"/><circle cx="26" cy="24" r="1.6" fill="#28182E"/><circle cx="22" cy="30" r="1.4" fill="#28182E"/></svg><span>Ratatouille <em>Fox</em></span></a><p>Vegetable-forward dinner ideas, tested home recipes and simple kitchen know-how for relaxed evenings around the table.</p></div>
      <div><h4>Cook</h4><a href="dinner-recipes.html">Dinner Recipes</a><a href="kitchen-guide.html">Kitchen Guide</a><a href="index.php#planner-sec">Dinner Planner</a><a href="index.php#recipe">Signature Ratatouille</a></div>
      <div><h4>Policies</h4><a href="privacy-policy.html">Privacy Policy</a><a href="terms-and-conditions.html">Terms &amp; Conditions</a><a href="cookie-policy.html">Cookie Policy</a><a href="disclaimer.html">Disclaimer</a><a href="editorial-policy.html">Editorial Policy</a></div>
      <div><h4>Contact</h4><p>181 Mercer Street, New York, NY 10012, United States</p><a href="tel:+18887775845">+1-888-777-5845</a><a href="mailto:hello@ratatouillefox.com">hello@ratatouillefox.com</a></div>
    </div>
    <div class="ftr-base"><span>&copy; <?php echo date("Y"); ?> Ratatouille Fox. All rights reserved.</span><span>Photography from Unsplash under the Unsplash License.</span></div>
  </div>
</footer>
<div class="cookie" id="cookie" role="dialog" aria-label="Cookie notice"><p>We use essential cookies and, with your permission, analytics cookies to see which recipes you enjoy most. <a href="cookie-policy.html">Cookie Policy</a></p><button class="y" data-cookie="accepted">Accept</button><button data-cookie="declined">Essential only</button></div>
<script src="assets/js/main.js" defer></script>
</body>
</html>
