$(function() {
  'use strict';
  
  $('#tanto').focus();

  // set
  $('#denpyos').on('click', '.hensyu', function() {
    // idを取得
    var id = $('li').data('id');
    // ajax処理
    $.post('_ajax.php', {
      id: id,
      mode: 'set',
      token: $('#token').val()
    }, function() {
      $('#tanto').val($('#tanto_' + id).text());
      $('#ymd').val($('#yyyymmdd_' + id).text());
      $('#omise_cd').val($('#omise_' + id).text());
      $('#omise_name').val($('#omiseName_' + id).text());
      $('#sir_cd').val($('#sir_' + id).text());
      $('#sir_name').val($('#sirName_' + id).text());
      $('select[name="item_cd"]').val($('#itemcd_' + id).text());
      $('#jyodai').val($('#jtanka_' + id).text());
      $('#gedai').val($('#gtanka_' + id).text());
      $('#siire').val($('#stanka_' + id).text());
      $(':radio[name="lease"]').val($('#lease_' + id).text());
    })
  });
  
  // update
  $('#headergo').on('click', function() {

    // idを取得
    var id = $('li').data('id');

    // ajax処理
    $.post('_ajax.php', {
      id: id,
      tanto: $(':text[name="tanto"]').val(),
      ymd: $(':text[name="ymd"]').val(),
      omise_cd: $(':text[name="omise_cd"]').val(),
      sir_cd: $(':text[name="sir_cd"]').val(),
      item_cd: $('select[name="item_cd"]').val(),
      jyodai: $(':text[name="jyodai"]').val(),
      gedai: $(':text[name="gedai"]').val(),
      siire: $(':text[name="siire"]').val(),
      lease: $('select[name="lease"]').val(),
      mode: 'update',
      token: $('#token').val()
    }, function(res) {
    })
  });

  // delete
  $('#denpyos').on('click', '.delete', function() {
    // idを取得
    var id = $(this).parents('li').data('id');
    // ajax処理
    if (confirm('are you sure?')) {
      $.post('_ajax.php', {
        id: id,
        mode: 'delete',
        token: $('#token').val()
      }, function() {
        $('#denpyo_' + id).fadeOut(800);
      });
    }
  });

  // create
  $('#new_todo_form').on('submit', function() {
    // titleを取得
    var title = $('#new_todo').val();
    // ajax処理
    $.post('_ajax.php', {
      title: title,
      mode: 'create',
      token: $('#token').val()
    }, function(res) {
      // liを追加
      var $li = $('#todo_template').clone();
      $li
        .attr('id', 'todo_' + res.id)
        .data('id', res.id)
        .find('.todo_title').text(title);
      $('#todos').prepend($li.fadeIn());
      $('#new_todo').val('').focus();
    });
    return false;
  });

});
