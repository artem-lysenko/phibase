; This file contains method for modification ontology file


(defun copy-buffer () 
"Copy content current buffer to the new one.
Finally it switch to the new buffer.
"
  (interactive)
  (let ((old-buff (current-buffer))
	(start-old (point-min))
	(end-old (point-max)))
    (set-buffer (generate-new-buffer "* Output *"))
    (message "buffer: %s created" (current-buffer))
    (insert-buffer-substring old-buff start-old end-old)
    (switch-to-buffer (current-buffer))))

(defun xml-work (function xpath)
"Evaluates FUNCTION on all nodes followed by XPATH. 
First find all nodes inside current-buffer XML file
")
