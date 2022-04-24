      <!-- END -->
      </main>
      </div>
      </div>
      <script>
        $(document).ready(function() {

          var temp = $(location).attr('pathname').split("/");
          var path = temp[temp.length - 2];
          var active = $(`.nav-link.${path}`);
          active.addClass("active");

        });
      </script>
      </body>

      </html>