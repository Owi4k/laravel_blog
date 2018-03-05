$(document).on("click", ".button__form", function(e) {
    e.preventDefault();
    var post_id = $("#post_id").val()
    this_url = `/post/${post_id}/feedback`;
    $.ajaxSetup({
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      }
    })
    var regular = /([A-Z-А-Я][a-z-а-я]+\s+[A-Z-А-Я][a-z-а-я]+)/;
    if(!regular.test($(".send_feedback #author").val() + ' ')) {
      	alert("Name must contain two words, both with a capital letter");
      return;
    }
    $.ajax({
      type: "POST",
      url: this_url,
      dataType: 'json',
      data: { 
      			author: $(".send_feedback #author").val(), 
      			content: $(".send_feedback #content").val() 
      		},
      success: function(feedback) {
      	$(".fb").append("<p>"+ feedback.created_at.split(' ')[0] +"<b>"+feedback.author+":</b>  "+feedback.content+"</p><hr>");
      	}
    });
});
