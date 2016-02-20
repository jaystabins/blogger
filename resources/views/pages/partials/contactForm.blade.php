
<div class="">
    <div class="form-area">  
      {!! Form::open([ 'url' => '/page/sendMail', 'id' => 'article_form']) !!}
        <br style="clear:both">
            <div class="form-group">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
          </div>
          <div class="form-group">
            <textarea name="bodyMessage" class="form-control" type="textarea" id="bodyMessage" placeholder="Message" maxlength="140" rows="7" required></textarea>                
          </div>
          {!! Form::submit('Send Mail', ['class' => 'btn btn-default pull-right', 'id' => 'submitBtn']) !!}
      {!! Form::close() !!}
    </div>
</div>
<div class="clearfix"></div>
