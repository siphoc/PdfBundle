CURRENT_DIR := $(PWD)

all: image vendor test

image:
	docker build -t siphoc/pdfbundle .

vendor:
	docker run --rm -d --name siphoc-pdfbundle-vendor siphoc/pdfbundle sh -c "while true; do sleep 1; done;"
	docker cp siphoc-pdfbundle-vendor:/home/pdfbundle/package/vendor ./vendor
	docker rm -f siphoc-pdfbundle-vendor

test:
	docker run --rm -it -v $(CURRENT_DIR):/home/pdfbundle/package siphoc/pdfbundle \
		vendor/bin/phpunit --coverage-text

.PHONY: all image vendor test
