<script>	
 
/*-------- Quiz Script ----------*/
	 
	var resultOneCount = 0; var resultTwoCount = 0;  var resultThreeCount = 0;
	
	jQuery(document).on('change', '.quiz-form_wrapper.gform_wrapper input[type=radio]', function() {
		
		jQuery(this).parents('.gchoice').addClass('vselected');
		
		var lastSelectedValue = jQuery(this).parents('.gchoice').siblings('.gchoice.vselected').find('input').attr('value');
		// console.log(lastSelectedValue);
		(lastSelectedValue === 'cosmetology') ? resultOneCount-- : '';
		(lastSelectedValue === 'esthetics') ? resultTwoCount-- : '';
		(lastSelectedValue === 'hairstylist') ? resultThreeCount-- : '';
		
		jQuery(this).parents('.gchoice').addClass('vselected').siblings('.gchoice').removeClass('vselected');
		
		var resultVoteLabel = jQuery(this).attr('value');  
		(resultVoteLabel === 'cosmetology') ? resultOneCount++ : '';
		(resultVoteLabel === 'esthetics') ? resultTwoCount++ : '';
		(resultVoteLabel === 'hairstylist') ? resultThreeCount++ : '';
		var resultFinal = [["cosmetology Votes", resultOneCount],["esthetics Votes",resultTwoCount],["hairstylist Votes",resultThreeCount]];
		console.table(resultFinal);	
	
	});
		

	jQuery(document).on('mouseenter', '#gform_submit_button_10', function(){
		var labelsArr = ['cosmetology', 'esthetics', 'hairstylist'];
		var arrMax = [resultOneCount,resultTwoCount, resultThreeCount];
		var maxElem = Math.max(...arrMax);
		var arrMaxIndex = arrMax.indexOf(maxElem);
		// console.log(arrMaxIndex);
		 jQuery('#input_10_41').val(labelsArr[arrMaxIndex]);
		localStorage.setItem("maxVotes", labelsArr[arrMaxIndex]);
		
	});
	
	// Show or hide elements based on the new value
	
	var showResultBlock = '.'+localStorage.getItem('maxVotes');
	jQuery(showResultBlock).show();

		
	/*-------- Quiz Script Ends ----------*/
 
 

</script>
