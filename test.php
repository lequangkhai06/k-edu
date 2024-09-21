<!DOCTYPE html>
<html>

<head>
    <title>Scroll to Load More Data</title>
    <style>
        #dataContainer {
            height: 300px;
            overflow: auto;
        }

        .dataItem {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .loading {
            text-align: center;
            padding: 10px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var page = 1;
            var isLoading = false;

            // Load more data on scroll
            $('#dataContainer').scroll(function() {
                if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight && !isLoading) {
                    loadMoreData(page);
                    page++;
                }
            });

            // Load initial data
            loadMoreData(page);
            page++;
        });

        function loadMoreData(page) {
            isLoading = true;
            $.ajax({
                url: 'data.php',
                type: 'POST',
                data: {
                    page: page
                },
                beforeSend: function() {
                    $('#dataContainer').append('<div class="loading">Loading...</div>');
                },
                success: function(response) {
                    if (response != '') {
                        $('#dataContainer').append(response);
                        isLoading = false;
                        $('.loading').remove();
                    }
                }
            });
        }
    </script>
</head>

<body>
    <div id="dataContainer">
        <!-- Initial data will be loaded here -->
    </div>
</body>

</html>