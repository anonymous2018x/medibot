<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function(){
		var tn = 'personal_details';

		/* data for selected record, or defaults if none is selected */
		var data = {
			infection: <?php echo json_encode(array('id' => $rdata['infection'], 'value' => $rdata['infection'], 'text' => $jdata['infection'])); ?>,
			symptom: <?php echo json_encode(array('id' => $rdata['symptom'], 'value' => $rdata['symptom'], 'text' => $jdata['symptom'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for infection */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'infection' && d.id == data.infection.id)
				return { results: [ data.infection ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for symptom */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'symptom' && d.id == data.symptom.id)
				return { results: [ data.symptom ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

