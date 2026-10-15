(function(){
  var b=document.querySelector('.burger'),n=document.getElementById('nav');
  if(b&&n)b.addEventListener('click',function(){var o=n.classList.toggle('open');b.setAttribute('aria-expanded',o?'true':'false');});
  // Dinner planner
  var D={
    pasta:['Fresh tomato &amp; basil pesto pasta','quick','veg','comfort','25 min','Vegetarian','Serves 4','Cook the pasta while you blitz basil, garlic, olive oil, nuts and grated hard cheese into a pesto. Toss with halved cherry tomatoes and a splash of pasta water.'],
    salad:['Warm roasted vegetable grain bowl','quick','veg','light','30 min','Vegetarian','Serves 2','Roast diced peppers and courgette while a pot of grains simmers. Pile everything into bowls with leaves, a lemon dressing and toasted seeds.'],
    soup:['Hearty bean &amp; vegetable soup','medium','veg','comfort','45 min','Vegetarian','Serves 6','Soften onion, carrot and celery, add garlic, tomatoes, beans and stock, then simmer until thick. Finish with greens and a drizzle of olive oil.'],
    fish:['Lemon &amp; herb roasted fish','medium','any','light','35 min','Pescatarian','Serves 4','Roast thinly sliced potatoes and vegetables, then lay fish fillets on top with lemon slices, herbs and olive oil for the last 12–15 minutes.'],
    chicken:['Herb-roasted chicken drumsticks','slow','any','comfort','1 hr 10 min','Family favourite','Serves 4','Rub drumsticks with garlic, thyme, paprika and olive oil, then roast on a bed of onions until the skin is crisp and the juices run clear.'],
    skillet:['One-pan skillet supper','quick','any','comfort','30 min','Weeknight','Serves 4','Brown sliced sausages or chickpeas in a cast iron pan, add peppers, onions and tomatoes, and cook until jammy. Serve with crusty bread.'],
    rata:['Slow-baked Provençal ratatouille','slow','veg','light','1 hr 30 min','Vegetarian','Serves 4','Layer thin slices of aubergine, courgette, tomato and pepper over a garlicky tomato base and bake slowly until meltingly tender.']
  };
  var pf=document.getElementById('planner');
  function plan(){if(!pf)return;var t=pf.querySelector('[name=time]:checked').value,s=pf.querySelector('[name=diet]:checked').value,m=pf.querySelector('[name=mood]:checked').value,best='rata',bs=-1;
    for(var k in D){var d=D[k],sc=(d[1]===t?3:0)+(s==='veg'?(d[2]==='veg'?3:-9):(d[2]==='any'?2:1))+(d[3]===m?2:0);if(sc>bs){bs=sc;best=k;}}
    var d=D[best];document.getElementById('p-name').innerHTML=d[0];
    document.getElementById('p-meta').innerHTML='<span>'+d[4]+'</span><span>'+d[5]+'</span><span>'+d[6]+'</span>';
    document.getElementById('p-desc').textContent=d[7];
    document.querySelectorAll('[data-dish]').forEach(function(i){i.hidden=i.dataset.dish!==best;});}
  if(pf){pf.addEventListener('change',plan);plan();}
  // Recipe scaler
  var out=document.getElementById('srv'),sv=4;
  function fmt(x){var w=Math.floor(x),f=x-w,fr='';if(f>=.875){w++;}else if(f>=.625)fr='¾';else if(f>=.4)fr='½';else if(f>=.2)fr='¼';return (w?w:'')+(w&&fr?' ':'')+fr||'¼';}
  function scale(){if(!out)return;out.textContent=sv+' serving'+(sv>1?'s':'');
    document.querySelectorAll('[data-q]').forEach(function(el){var q=parseFloat(el.dataset.q)*sv/4,u=el.dataset.u||'';el.textContent=(el.dataset.int?Math.max(1,Math.round(q)):fmt(q))+(u?' '+u:'');});}
  document.querySelectorAll('[data-sv]').forEach(function(x){x.addEventListener('click',function(){sv=Math.min(12,Math.max(1,sv+parseInt(x.dataset.sv,10)));scale();});});
  scale();
  // Cookie
  var c=document.getElementById('cookie'),v=null;try{v=localStorage.getItem('rf_cookie');}catch(e){}
  if(c&&!v)c.classList.add('show');
  document.querySelectorAll('[data-cookie]').forEach(function(x){x.addEventListener('click',function(){try{localStorage.setItem('rf_cookie',x.dataset.cookie);}catch(e){}c.classList.remove('show');});});
  var y=document.getElementById('year');if(y)y.textContent=new Date().getFullYear();
})();
