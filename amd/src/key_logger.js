define(["jquery", "core/ajax", "core/str", "core/templates"], function (
  $,
  AJAX,
  str,
  templates
) {
  var usersTable = {
    init: function (page) {
      str
        .get_strings([
          { key: "field_require", component: "tiny_keylogger" },
          { key: "quiz_attempt", component: "tiny_keylogger" },
          { key: "valid_time", component: "tiny_keylogger" },
        ])
        .done(function (s) {
          window.console.log(s);
          usersTable.getusers(page);
        });
    },

    getusers: function (page) {
      $("#fgroup_id_buttonar").hide();
      $("#id_coursename").change(function () {
        var courseid = $(this).val();
        var promise1 = AJAX.call([
          {
            methodname: "keylogger_get_user_list",
            args: {
              courseid: courseid,
            },
          },
        ]);
        promise1[0].done(function (json) {
          var data = JSON.parse(json);
          var context = {
            tabledata: data,
            page: page,
          };
          templates
            .render("tiny_keylogger/user_list", context)
            .then(function (html, js) {
              window.console.log(js);
              var filtered_user = $("#id_username");

              filtered_user.html(html);
            });
        });

        var promise2 = AJAX.call([
          {
            methodname: "keylogger_get_module_list",
            args: {
              courseid: courseid,
            },
          },
        ]);
        promise2[0].done(function (json) {
          var data = JSON.parse(json);
          var context = {
            tabledata: data,
            page: page,
          };
          templates
            .render("tiny_keylogger/user_list", context)
            .then(function (html, js) {
              window.console.log(js);
              var filtered_user = $("#id_modulename");

              filtered_user.html(html);
            });
        });
      });
    },
  };
  return usersTable;
});
