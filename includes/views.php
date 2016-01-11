<?php

mysql_query("UPDATE threads SET views = views+1 WHERE id = $threadId");
