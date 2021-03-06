<div class="wrap">
	<h1><?php _e('Add/Edit Chained Quiz', 'chained')?></h1>
	
	<div class="postbox-container" style="width:73%;margin-right:2%;">
	
		<p><a href="admin.php?page=chained_quizzes"><?php _e('Back to quizzes', 'chained')?></a>
		<?php if(!empty($quiz->id)):?>
			| <a href="admin.php?page=chainedquiz_questions&quiz_id=<?php echo $quiz->id?>"><?php _e('Manage Questions', 'chained')?></a>
			| <a href="admin.php?page=chainedquiz_results&quiz_id=<?php echo $quiz->id?>"><?php _e('Manage Results / Outcomes', 'chained')?></a>
		<?php endif;?></p>
		
		<form method="post" onsubmit="return validateChainedQuiz(this);">
			<p><label><?php _e('Quiz Title', 'chained')?></label> <input type="text" name="title" size="60" value="<?php echo stripslashes(@$quiz->title)?>"></p>
			
			<p><label><?php _e('Final Output', 'chained')?></label> <?php echo wp_editor(stripslashes($output), 'output')?></p>
			
			<p><?php _e('This is the content that is shown to the user after they complete the quiz. The following variables can be used:', 'chained')?></p>
			
			<ul>
				<li>{{result-title}} <?php _e('- The result (grade) title', 'chained')?></li>
				<li>{{result-text}} <?php _e('- The result (grade) text/description', 'chained')?></li>
				<li>{{points}} <?php _e('- Points collected', 'chained')?></li>
				<li>{{questions}} <?php _e('- The number of total questions answered', 'chained')?></li>
				<li>{{answers-table}} <?php _e('- A table with the questions, answers given by the user, correct / wrong info and points collected.', 'chained')?></li>
				<!-- (let's leave this for the next version) li>{{correct}} <?php _e('- The number of correctly answered questions', 'chained')?></li-->
			</ul>	
			
			<p><input type="checkbox" name="require_login" value="1" <?php if(!empty($quiz->require_login)) echo 'checked'?> onclick="this.checked ? jQuery('#timesToTake').show() : jQuery('#timesToTake').hide(); "> <?php _e('Require user login to take this quiz.', 'chained');?>
				<span id="timesToTake" style="display:<?php echo empty($quiz->require_login) ? 'none' : 'inline';?>">
					<?php printf(__('Limit quiz attempts to %s. (Enter 0 for unlimited attempts.)', 'chained'), '<input type="text" size="3" name="times_to_take" value="'.(empty($quiz->times_to_take) ? 0 : $quiz->times_to_take).'">');?> 			
				</span>		
			</p>		
			
			<p><input type="checkbox" name="email_admin" value="1" <?php if(!empty($quiz->email_admin)) echo 'checked'?>> <?php _e('Send me email when user completes this quiz. It will be delivered to the email address from your main WP Settings page.', 'chained');?></p>
			<p><input type="checkbox" name="email_user" value="1" <?php if(!empty($quiz->email_user)) echo 'checked'?>> <?php _e('Send email to user with their result. If the user is not logged in visitor an optional "Enter email" field will automatically appear above the quiz.', 'chained');?></p>
			<p><input type="checkbox" name="save_source_url" value="1" <?php if(!empty($quiz->save_source_url)) echo 'checked'?>> <?php _e('Save source URL when submitting the quiz (useful if you have published the quiz in multiple places on your site).', 'chained');?></p>
				
			<?php if(!$is_published):?>
				 	<p><input type="checkbox" name="auto_publish" value="1"> <?php _e('Automatically publish this quiz in new post once I hit the "Save" button. (The new post will be auto-generated with the quiz title used for post title.)', 'chained')?></p>
			<?php endif;?>
			
			<p><input type="submit" value="<?php _e('Save Quiz', 'chained')?>" class="button-primary"></p>
			<input type="hidden" name="ok" value="1">
			<?php wp_nonce_field('chained_quiz');?>
		</form>
		
	</div>
	<div id="chained-sidebar">
			<?php include(CHAINED_PATH."/views/sidebar.html.php");?>
	</div>	
</div>

<script type="text/javascript" >
function validateChainedQuiz(frm) {
	if(frm.title.value == '') {
		alert("<?php _e('Title is required', 'chained')?>");
		frm.title.focus();
		return false;
	}
	
	return true;
}
</script>