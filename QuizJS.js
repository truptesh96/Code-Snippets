
<script>
 
/*-------- Quiz Script ----------*/
	 
	jQuery( function($) {
		var resultOneCount = 0; var resultTwoCount = 0;
	
		jQuery(document).on('change', '.quiz-form_wrapper.gform_wrapper input[type=radio]', function() {

			jQuery(this).parents('.gchoice').addClass('vselected');

			var lastSelectedValue = jQuery(this).parents('.gchoice').siblings('.gchoice.vselected').find('input').attr('value');
			console.log(lastSelectedValue);
			(lastSelectedValue === 'Cosmetology') ? resultOneCount-- : '';
			(lastSelectedValue === 'Esthetics') ? resultTwoCount-- : '';

			jQuery(this).parents('.gchoice').addClass('vselected').siblings('.gchoice').removeClass('vselected');

			var resultVoteLabel = jQuery(this).attr('value');  
			(resultVoteLabel === 'Cosmetology') ? resultOneCount++ : '';
			(resultVoteLabel === 'Esthetics') ? resultTwoCount++ : '';

			var resultFinal = [["Cosmetology Votes", resultOneCount],["Esthetics Votes",resultTwoCount]];
			console.table(resultFinal);	

		});
		
		
		jQuery(document).on('change', '.quiz-form_wrapper.gform_wrapper input[type=checkbox]', function() {

			jQuery(this).parents('.gchoice').toggleClass('vselected');

			var lastSelectedValue = jQuery(this).parents('.gchoice').find('input').attr('value');
			var resultVoteLabel = jQuery(this).attr('value');  
			
			if ( !jQuery(this).parents('.gchoice').hasClass('vselected') ) {
				(lastSelectedValue === 'Cosmetology') ? resultOneCount-- : '';
				(lastSelectedValue === 'Esthetics') ? resultTwoCount-- : '';			
			} else {
				(resultVoteLabel === 'Cosmetology') ? resultOneCount++ : '';
				(resultVoteLabel === 'Esthetics') ? resultTwoCount++ : '';			
			}
	
			var resultFinal = [["Cosmetology Votes", resultOneCount],["Esthetics Votes",resultTwoCount]];
			console.table(resultFinal);	

		}); 

		jQuery(document).on('mouseenter', '.quiz-form_wrapper [type="submit"]', function(){
			var labelsArr = ['Cosmetology', 'Esthetics'];
			var arrMax = [resultOneCount,resultTwoCount];
			var maxElem = Math.max(...arrMax);
			var arrMaxIndex = arrMax.indexOf(maxElem);
			 console.log(arrMaxIndex);
			 jQuery('#input_5_38').val(labelsArr[arrMaxIndex]);
			localStorage.setItem("maxVotes", labelsArr[arrMaxIndex]);

		});

		// Show or hide elements based on the new value

		var showResultBlock = '.'+localStorage.getItem('maxVotes');
		jQuery(showResultBlock).show();


		/*-------- Quiz Script Ends ----------*/
		
		
	})
	
  
	
</script>
