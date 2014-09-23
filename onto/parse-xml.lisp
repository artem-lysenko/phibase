#!/usr/bin/sbcl --script
(load (merge-pathnames (user-homedir-pathname) 
		       #+SBCL ".sbclrc"))

(let ((*standard-output* (make-broadcast-stream)))
(ql:quickload "cl-libxml2"))

;; add owl namespace
(nconc xpath:*default-ns-map* '(("owl" "http://www.w3.org/2002/07/owl#")))
;;(nconc xpath:*default-ns-map* '(("t" "http://test.com/")))
;;(format t "mapa ::::~a ~%~%" xpath:*default-ns-map*)

(defun change-assertion (node)
  "Modify content of nodes owl:AnnotationAssertion"
  (let ((abbreviated-iri (xpath:find-string node "owl:AnnotationProperty/@abbreviatedIRI"))
	(literal-node nil)
	(literal-value nil))
    (cond 
      ((string= "rdfs:isDefinedBy" abbreviated-iri)
       (setf literal-node (xpath:find-single-node node "owl:Literal"))
       (setf literal-value (xtree:text-content literal-node))
       (format t "~cIRI: ~a~%" #\tab literal-value))))
)


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

(parse-xml (parse-namestring "phibase-rdf-ontology-28-08-14.owl") "//owl:AnnotationAssertion" #'change-assertion)
