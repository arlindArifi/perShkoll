</div> <!-- mbyll wrapper -->

<script>
document.addEventListener('DOMContentLoaded', function(){
  const el = document.getElementById('stockChart');
  if(el){
    const labels = JSON.parse(el.dataset.labels || '[]');
    const data = JSON.parse(el.dataset.data || '[]');
    new Chart(el.getContext('2d'), {
      type: 'bar',
      data: { labels, datasets:[{ label:'Stok', data }] },
      options: { responsive:true, plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true}} }
    });
  }
});
</script>

</body>
</html>
