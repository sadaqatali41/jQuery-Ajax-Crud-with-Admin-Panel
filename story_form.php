<!-- your story modal popup starts here -->
<div id="your_story" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center text-primary">
        	<em>Your Story</em>
        </h4>
      </div>
      <div class="modal-body">
      	<form method="post" action="#">
      		<p id="error_sms"></p>
	        <textarea class="form-control" id="story" name="story" placeholder="Write something about yourself." rows="10" style="resize: none;"></textarea>
	        <br>
	        <button type="button" class="btn btn-success" id="update_story">Update Story</button>
	    </form>
	   </div>
    </div>
  </div>
</div>
<!-- your story modal popup ends here -->