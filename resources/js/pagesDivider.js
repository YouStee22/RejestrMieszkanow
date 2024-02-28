            console.log("PagesDivider ładuje")
            var pages = [];
            let accPage = 0;
            pagesDividerAlgorithm();
           

            
            function pagesDividerAlgorithm() { 
                let ele = [];
                let divs = document.querySelectorAll('.elementDiv');

                let pgAtx = 0;
                let obj = '';
                for (let i = 0; i < divs.length; i++) {
                    if ((i % 4 == 0)  &&  (i > 2)) {
                        pages.push(obj);
                        obj = '';
                    } 
                    obj += divs[i].innerHTML;
                }
                console.log(obj)
                pages.push(obj);

                document.querySelector('#citiesDiv').innerHTML = pages[accPage];
               
                document.querySelectorAll('.infoPages').forEach(element => {
                   element.innerText = accPage + 1;
                });
            }
            
            function goBack() {
                accPage--;
                let pageNum = accPage + 1
                document.querySelectorAll('.infoPages').forEach(element => {
                   element.innerText = pageNum;
                });
                document.querySelector('#citiesDiv').innerHTML = pages[accPage];
            }

            function goNext() {
                accPage++;
                let pageNum = accPage + 1
                document.querySelectorAll('.infoPages').forEach(element => {
                   element.innerText = pageNum;
                });
                document.querySelector('#citiesDiv').innerHTML = pages[accPage];
            }