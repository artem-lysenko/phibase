;;#!/usr/bin/sbcl --script


(let ((*standard-output* (make-broadcast-stream)))
(ql:quickload "cl-libxml2"))

;; add owl namespace
;;(nconc xpath:*default-ns-map* '(("owl" "http://www.w3.org/2002/07/owl#")))
;;(nconc xpath:*default-ns-map* '(("t" "http://test.com/")))
;;(format t "mapa ::::~a ~%~%" xpath:*default-ns-map*)

;; create xpath function

(defun change (node) 
  (format t "~c node description: ~a ~%" #\tab (xtree:local-name node))
  (let* ((sub2 (xpath:find-list node "t:sub2"))
	 (it (nth 0 sub2)))
    (format t "~C~Csize: ~s~%" #\tab #\tab (length sub2))
    (format t "~C~Cnode: ~s attr: ~S~%" #\tab #\tab 
                                        (xtree:local-name it)
	                                (xtree:attribute-value it "zu"))))

(defun node-value (node)
  (format t "for node: ~a~%" (xtree:local-name node))
  (let ((cl (xpath:find-list node "owl:Class")))
    (loop for i in cl 
	 do (format t "~Cattribute: ~s~%" #\tab (xtree:attribute-value i "IRI"))))
)


;; (defun has-is-defined-by-p (n) 
;;   "Check if node is rdfs:isDefinedBy"
;;   (if (< 0 
;; 	 (length (xpath:find-list n "owl:AnnotationProperty[@abbreviatedIRI='rdfs:isDefinedBy']"))) 'true 'nil))

;; (defun change-assertion (node)

;;   )



(defun parse-xml (document-stream xpath function)
"execute function on all nodes with xpath for the input document"
(let* ((document (xtree:parse document-stream))
       (nodes (xpath:find-list document xpath)))
     (format t "out document: ~s~%" document)
     (loop for i in nodes
	  do (if (functionp function) 
		 (funcall function i)
		 (format t "no function argument~%")))
))

;;(parse-xml (parse-namestring "test/test-nn.xml") "//t:Branch" #'change)
(parse-xml (parse-namestring "phibase-rdf-ontology-28-08-14.owl") "//owl:AnnotationAssertion" #'change-assertion)
