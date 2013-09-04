<?php

class MY_Pagination extends CI_Pagination {

	public function create_links()
	{
		$base_url = $this->base_url;
		$prefix = $this->prefix;
		$suffix = $this->suffix;
		$total_rows = $this->total_rows;
		$per_page = $this->per_page;
		$num_links = $this->num_links;
		$cur_page = $this->cur_page;
		$use_page_numbers = $this->use_page_numbers;
		$first_link = $this->first_link;
		$next_link = $this->next_link;
		$prev_link = $this->prev_link;
		$last_link = $this->last_link;
		$uri_segment = $this->uri_segment;
		$full_tag_open = $this->full_tag_open;
		$full_tag_close = $this->full_tag_close;
		$first_tag_open = $this->first_tag_open;
		$first_tag_close = $this->first_tag_close;
		$last_tag_open = $this->last_tag_open;
		$last_tag_close = $this->last_tag_close;
		$first_url = $this->first_url;
		$cur_tag_open = $this->cur_tag_open;
		$cur_tag_close = $this->cur_tag_close;
		$next_tag_open = $this->next_tag_open;
		$next_tag_close = $this->next_tag_close;
		$prev_tag_open = $this->prev_tag_open;
		$prev_tag_close = $this->prev_tag_close;
		$num_tag_open = $this->num_tag_open;
		$num_tag_close = $this->num_tag_close;
		$page_query_string = $this->page_query_string;
		$query_string_segment = $this->query_string_segment;
		$display_pages = $this->display_pages;
		$anchor_class = $this->anchor_class;

		// If our item count or per-page total is zero there is no need to continue.

		if ($total_rows === 0 OR $per_page === 0)
		{
			return '';
		}
		else
		{
			// Calculate the total number of pages
			$num_pages = ceil($total_rows / $per_page);
		}

		// Is there only one page? Hm... nothing more to do here then.
		if ($num_pages == 1)
		{
			return '';
		}
		elseif ($use_page_numbers)
		{// Set the base page index for starting page number
			$base_page = 1;
		}
		else
		{
			$base_page = 0;
		}

		// Determine the current page number.
		$CI =& get_instance();

		if ($CI->config->item('enable_query_strings') === TRUE OR $page_query_string === TRUE)
		{
			if ($CI->input->get($query_string_segment) != $base_page)
			{
				$cur_page = $CI->input->get($query_string_segment);

				// Prep the current page - no funny business!
				$cur_page = (int) $cur_page;
			}
		}
		else
		{
			if ($CI->uri->segment($uri_segment) != $base_page)
			{
				$cur_page = $CI->uri->segment($uri_segment);

				// Prep the current page - no funny business!
				$cur_page = (int) $cur_page;
			}
		}
		
		// Set current page to 1 if using page numbers instead of offset
		if ($use_page_numbers AND $cur_page == 0)
		{
			$cur_page = $base_page;
		}

		$num_links = (int)$num_links;

		if ($num_links < 1)
		{
			show_error('Your number of links must be a positive number.');
		}

		if ( ! is_numeric($cur_page))
		{
			$cur_page = $base_page;
		}

		// Is the page number beyond the result range?
		// If so we show the last page
		if ($use_page_numbers)
		{
			if ($cur_page > $num_pages)
			{
				$cur_page = $num_pages;
			}
		}
		else
		{
			if ($cur_page > $total_rows)
			{
				$cur_page = ($num_pages - 1) * $per_page;
			}
		}

		$uri_page_number = $cur_page;
		
		if ( ! $use_page_numbers)
		{
			$cur_page = floor(($cur_page/$per_page) + 1);
		}

		// Calculate the start and end numbers. These determine
		// which number to start and end the digit links with
		$start = (($cur_page - $num_links) > 0) ? $cur_page - ($num_links - 1) : 1;
		$end   = (($cur_page + $num_links) < $num_pages) ? $cur_page + $num_links : $num_pages;

		// Is pagination being used over GET or POST?  If get, add a per_page query
		// string. If post, add a trailing slash to the base URL if needed
		if ($CI->config->item('enable_query_strings') === TRUE OR $page_query_string === TRUE)
		{
			$base_url = rtrim($base_url).'&amp;'.$query_string_segment.'=';
		}
		else
		{
			$base_url = rtrim($base_url, '/') .'/';
		}

		// And here we go...
		$output = '';

		// Render the "First" link
		if  ($first_link !== FALSE AND $cur_page > ($num_links + 1))
		{
			$first_url = ($first_url == '') ? $base_url : $first_url;
			$output .= $first_tag_open.'<a '.$anchor_class.'href="'.$first_url.'">'.$first_link.'</a>'.$first_tag_close;
		}

		// Render the "previous" link
		if  ($prev_link !== FALSE AND $cur_page != 1)
		{
			if ($use_page_numbers)
			{
				$i = $uri_page_number - 1;
			}
			else
			{
				$i = $uri_page_number - $per_page;
			}

			if ($i == 0 && $first_url != '')
			{
				$output .= $prev_tag_open.'<a '.$anchor_class.'href="'.$first_url.'">'.$prev_link.'</a>'.$prev_tag_close;
			}
			else
			{
				$i = ($i == 0) ? '' : $prefix.$i.$suffix;
				$output .= $prev_tag_open.'<a '.$anchor_class.'href="'.$base_url.$i.'">'.$prev_link.'</a>'.$prev_tag_close;
			}

		}

		// Render the pages
		if ($display_pages !== FALSE)
		{
			// Write the digit links
			for ($loop = $start -1; $loop <= $end; ++$loop)
			{
				if ($use_page_numbers)
				{
					$i = $loop;
				}
				else
				{
					$i = ($loop * $per_page) - $per_page;
				}

				if ($i >= $base_page)
				{
					if ($cur_page == $loop)
					{
						$output .= "$cur_tag_open$loop$cur_tag_close"; // Current page
					}
					else
					{
						$n = ($i === $base_page) ? '' : $i;

						if ($n === '' && $first_url != '')
						{
							$output .= $num_tag_open.'<a '.$anchor_class.'href="'.$first_url.'">'.$loop.'</a>'.$num_tag_close;
						}
						else
						{
							$n = ($n === '') ? '' : $prefix.$n.$suffix;

							$output .= "$num_tag_open<a {$anchor_class}href=\"$base_url$n\">$loop</a>$num_tag_close";
						}
					}
				}
			}
		}

		// Render the "next" link
		if ($next_link !== FALSE AND $cur_page < $num_pages)
		{
			if ($use_page_numbers)
			{
				$i = $cur_page + 1;
			}
			else
			{
				$i = ($cur_page * $per_page);
			}

			$output .= $next_tag_open.'<a '.$anchor_class.'href="'.$base_url.$prefix.$i.$suffix.'">'.$next_link.'</a>'.$next_tag_close;
		}

		// Render the "Last" link
		if ($last_link !== FALSE AND ($cur_page + $num_links) < $num_pages)
		{
			if ($use_page_numbers)
			{
				$i = $num_pages;
			}
			else
			{
				$i = (($num_pages * $per_page) - $per_page);
			}
			$output .= $last_tag_open.'<a '.$anchor_class.'href="'.$base_url.$prefix.$i.$suffix.'">'.$last_link.'</a>'.$last_tag_close;
		}

		// Kill double slashes.  Note: Sometimes we can end up with a double slash
		// in the penultimate link so we'll kill all double slashes.

		// Add the wrapper HTML if exists
		return $full_tag_open.preg_replace("#([^:])//+#", "\\1/", $output).$full_tag_close;
	}

}
// END MY_Session Class

/* End of file MY_Pagination.php */
/* Location: ./system/libraries/MY_Pagination.php */