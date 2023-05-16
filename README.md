# software_engineering_final
此專案為我們自己手刻麥當勞點餐系統，所設計的資料庫與API程式碼，也是我在此專案的貢獻。  
是我們大三上軟體工程課的final project，在這個實作中我接觸到後端、API的概念，由於麥當勞點餐系統不同的頁面與功能，需要提供不同的資訊，像是單點與套餐、客製化內容、訂單資訊提供等，資料庫與API的架構設計，經過反覆的規畫討論與修改，在此提供檔案與程式碼。  
過程中遇到問題的紀錄於[my blog](https://peggyshenblog.blogspot.com/2023/03/cross-origin-request-blocked-mixed.html)。  
另外負責撰寫[測試報告](https://docs.google.com/document/d/14Y0hdzthHoneP0MGVI4QRNZvm_bvPDHJvwz9rdFm2t4/edit?usp=share_link)使用Sahi Pro做網頁回歸測試。

關於資料庫設計:  
1.說明  
分為八大資料表，分別為 SingalFood、FoodType、Foods、Order、AddonFood、Foods_Customization、Customization、ComboFood，由主要 foods 去參考其他 tables，為了避免一個人點多份單點、套餐用了 NO 屬性來區別每份，而一份訂單只會有一份 Order，並由 Order 去參考 Foods。  
2.ERD
![image](https://user-images.githubusercontent.com/71923853/235461581-0fb2a1d7-3d54-4a3a-9b0c-d839a336eecb.png)
ERD有部分錯誤  
圖中的(one and only one)
![one-and-only-one2](https://github.com/pei-ci/software_engineering_final/assets/71923853/59dff665-7066-4037-9084-b438953c4ce5)
應改成 one or many
![one-or-many2](https://github.com/pei-ci/software_engineering_final/assets/71923853/ae3c0ae9-d731-4a84-8867-b883e52b3a17)
