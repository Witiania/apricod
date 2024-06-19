Create User:
POST
Path[/]  
Request: Body: {
"name": "Molot",
"developerStudio": "Molot studio",
"genres": [
"horror",
"action"
]
}  
Response: {
"id": 26,
"name": "Molot",
"developerStudio": "Molot studio",
"genres": {
"27": "horror",
"28": "action"
}
}  

Get User:
GET
Path[/{id}]  
Response: {
"id": 26,
"name": "Molot",
"developerStudio": "Molot studio",
"genres": {
"27": "horror",
"28": "action"
}
}  

Update Game:
PUT
Path[/26]  
Request: Body {
"name": "Molotok",
"developerStudio": "Molotok studio",
"genres": {
"27": "horror",
"28": "strategy"
}
}  
Response: {
"id": 26,
"name": "Molotok",
"developerStudio": "Molotok studio",
"genres": {
"27": "horror",
"29": "strategy"
}
}  

Delete Game:
DELETE
Path[/{id}]
Response: "game deleted"

Game List:
GET
Path{/list/{name_genre}}  
Example: Request: /list/s  
Response: {
"games": [  
{
"id": 5,
"name": "asda",
"developerStudio": "s dis",
"genres": {
"15": "s",
"16": "s",
"17": "s"
}
},  
{
"id": 10,
"name": "sadasd",
"developerStudio": "sads dis",
"genres": {
"14": "e",
"15": "s"
}
},  
{
"id": 11,
"name": "sadasdasdasd",
"developerStudio": "sads dis",
"genres": {
"10": "d",
"14": "e",
"15": "s"
}
},  
{
"id": 12,
"name": "sadasasdxcdasdasd",
"developerStudio": "sadzxczcvs dis",
"genres": {
"10": "d",
"14": "e",
"15": "s"
}
},  
{
"id": 15,
"name": "фывфывфыв",
"developerStudio": "zxcsadaыфвафвыаыфвавsdzxc studio",
"genres": {
"15": "s"
}
},  
{
"id": 16,
"name": "asdasda",
"developerStudio": "sdasda studio",
"genres": {
"15": "s",
"21": "i",
"22": "o"
}
},  
{
"id": 18,
"name": "asdaasdasdsda",
"developerStudio": "sdaasdasdsda studio",
"genres": {
"15": "s",
"22": "o",
"23": "g"
}
},  
{
"id": 19,
"name": "asdaasdasdsda",
"developerStudio": "sdaasdasdsda studio",
"genres": {
"15": "s",
"22": "o",
"23": "g"
}
},  
{
"id": 20,
"name": "asdaasdasdsda",
"developerStudio": "sdaasdasdsda studio",
"genres": {
"15": "s",
"22": "o",
"23": "g"
}
},  
{
"id": 21,
"name": "asdaasdasdsda",
"developerStudio": "sdaasdasdsda studio",
"genres": {
"15": "s",
"22": "o",
"23": "g"
}
},  
{
"id": 22,
"name": "asdaasdasdsda",
"developerStudio": "sdaasdasdsda studio",
"genres": {
"15": "s",
"22": "o",
"23": "g"
}
},  
{
"id": 23,
"name": "asdaasdasdsda",
"developerStudio": "sdaasdasdsda studio",
"genres": {
"15": "s",
"22": "o",
"23": "g"
}
}  
]}




