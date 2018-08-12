<!DOCTYPE html5>
<html>
	<head>
				<title>POPCORN EDITOR</title>
				<meta charset="utf-8">
	</head>
	<body>
		<?php /*
		<button onclick="loadInfo()">Post message</button>
		*/ ?>
		<div id="editor" style="width: 100%; height: 100%;"></div>
		<script src="PopcornEditor/src/PopcornEditor.js"></script>
		<script>

				PopcornEditor.listen(PopcornEditor.events.save, function(message) {
					console.log(JSON.stringify(message))
				});

				PopcornEditor.listen(PopcornEditor.events.loaded, function () {
					var video = {
								"thumbnail": "http://ep01.epimg.net/elpais/imagenes/2015/10/19/ciencia/1445271172_891155_1445332934_portada_normal.jpg",
								"url": "https://d3fenhwk93s16g.cloudfront.net/3i9x0m/webm.webm",
								"title": "Assessments San Francisco Move",
								"duration": 3192,
								"type": "AirMozilla"
					};

					//PopcornEditor.loadInfo(PopcornEditor.createTemplate(video));
					console.log(video);
					//console.log(PopcornEditor.createTemplate(video));

					loadInfo()
				});        

				function loadInfo() {
					var a = {
						"template": "basic",
						"author": "TODO",
						"thumbnail": "http://ep01.epimg.net/elpais/imagenes/2015/10/19/ciencia/1445271172_891155_1445332934_portada_normal.jpg",
						"background": "#05c900",
						"data": {
							"targets": [
								{
									"id": "Target0",
									"name": "video-container",
									"element": "video-container"
								}
							],
							"media": [
								{
									"id": "Media0",
									"name": "Media0",
									"url": "#t=,23.369",
									"target": "video",
									"duration": 23.369,
									"popcornOptions": {
										"frameAnimation": true
									},
									"controls": true,
									"tracks": [
										{
											"name": "",
											"id": "0",
											"order": 0,
											"trackEvents": [
												{
													"id": "TrackEvent0",
													"type": "sequencer",
													"popcornOptions": {
														"start": 0,
														"source": [
															"https://d3fenhwk93s16g.cloudfront.net/c9o8b0/hd_webm.webm?t=1436213450559ae0cad74cd&butteruid=1436213446270"
														],
														"fallback": "",
														"denied": false,
														"end": 23.369,
														"from": 0,
														"title": "Safari Browsing",
														"type": "AirMozilla",
														"thumbnailSrc": "https://air.cdn.mozilla.net/media/cache/9f/ff/9fff395105bf200cd23a5f6f2f6df520.png",
														"duration": 23.369,
														"linkback": "",
														"contentType": "",
														"hidden": false,
														"target": "video-container",
														"left": 16.29148527836351,
														"top": 0,
														"width": 73.09152854617142,
														"height": 100,
														"volume": 100,
														"mute": false,
														"zindex": 1000,
														"id": "TrackEvent0"
													},
													"track": "0",
													"name": "TrackEvent0"
												}
											]
										},
										{
											"name": "",
											"id": "2",
											"order": 1,
											"trackEvents": [
												{
													"id": "TrackEvent1",
													"type": "sequencer",
													"popcornOptions": {
														"start": 6.827133479212254,
														"source": [
															"https://d3fenhwk93s16g.cloudfront.net/m4u2k6/hd_webm.webm?t=1436213481559ae0e916b16&butteruid=1436213446271"
														],
														"fallback": "",
														"denied": false,
														"end": 16.027133479212253,
														"from": 0,
														"title": "Testing my face",
														"type": "AirMozilla",
														"thumbnailSrc": "https://air.cdn.mozilla.net/media/cache/ef/55/ef555f851da046f5bcb833fb679654fd.png",
														"duration": 9.2,
														"linkback": "",
														"contentType": "",
														"hidden": false,
														"target": "video-container",
														"left": 24.058526495858025,
														"top": 0,
														"width": 75.84346862697606,
														"height": 75.92954990215264,
														"volume": 100,
														"mute": false,
														"zindex": 999,
														"id": "TrackEvent1"
													},
													"track": "2",
													"name": "TrackEvent1"
												}
											]
										}
									],
									"clipData": {
										"https://d3fenhwk93s16g.cloudfront.net/c9o8b0/hd_webm.webm?t=1436213450559ae0cad74cd": {
											"type": "AirMozilla",
											"title": "Safari Browsing",
											"source": "https://d3fenhwk93s16g.cloudfront.net/c9o8b0/hd_webm.webm?t=1436213450559ae0cad74cd",
											"thumbnail": "https://air.cdn.mozilla.net/media/cache/9f/ff/9fff395105bf200cd23a5f6f2f6df520.png",
											"duration": 23.369
										},
										"https://d3fenhwk93s16g.cloudfront.net/m4u2k6/hd_webm.webm?t=1436213481559ae0e916b16": {
											"type": "AirMozilla",
											"title": "Testing my face",
											"source": "https://d3fenhwk93s16g.cloudfront.net/m4u2k6/hd_webm.webm?t=1436213481559ae0e916b16",
											"thumbnail": "https://air.cdn.mozilla.net/media/cache/ef/55/ef555f851da046f5bcb833fb679654fd.png",
											"duration": 9.2
										}
									},
									"currentTime": 0
								}
							]
						},
						"tags": [
							"popcorn"
						]
					}
					var b = {
							"targets": [
									{
											"id": "Target0",
											"name": "video-container",
											"element": "video-container"
									}
							],
							"media": [
									{
											"id": "Media0",
											"name": "Media0",
											"url": [
													"https://www.youtube.com/watch?v=0g2WE1qXiKM"
											],
											"target": "video",
											"duration": 925.08,
											"controls": false,
											"tracks": [
													{
															"name": "Layer 0",
															"id": "0",
															"trackEvents": [
																	{
																			"id": "TrackEvent0",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 0.90296,
																					"end": 4.86411,
																					"target": "video-container",
																					"text": "This video has been augmented\nwith Popcorn Maker!",
																					"linkUrl": "",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "info",
																					"flip": "",
																					"top": 68.80952380952381,
																					"left": 9.285714285714286,
																					"width": 30,
																					"transition": "popcorn-pop",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent2"
																	},
																	{
																			"id": "TrackEvent1",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 31.19196,
																					"end": 37.38126,
																					"target": "video-container",
																					"text": "Much of Beau's work explores human perception",
																					"linkUrl": "",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "eye",
																					"flip": "",
																					"top": 8.174603174603174,
																					"left": 62.857142857142854,
																					"width": 30,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent4"
																	},
																	{
																			"id": "TrackEvent2",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 78.47502,
																					"end": 100.75648,
																					"target": "video-container",
																					"text": "Watch this frog on YouTube",
																					"linkUrl": "http://www.youtube.com/watch?v=LwrNy2lgITY",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "tv",
																					"flip": "",
																					"top": 77.77777777777779,
																					"left": 13.750000000000002,
																					"width": 35.892857142857146,
																					"transition": "popcorn-pop",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent7"
																	},
																	{
																			"id": "TrackEvent3",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 114.43069,
																					"end": 119.43069,
																					"target": "video-container",
																					"text": "Beau is a Doctor of Philosophy",
																					"linkUrl": "",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "info",
																					"flip": "",
																					"top": 68.17460317460318,
																					"left": 9.285714285714286,
																					"width": 30,
																					"transition": "popcorn-pop",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent9"
																	},
																	{
																			"id": "TrackEvent4",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 129.56776,
																					"end": 133.87285,
																					"target": "video-container",
																					"text": "He is a member of the Vision Network\nResearch Group at\nUniversity College London",
																					"linkUrl": "https://iris.ucl.ac.uk/iris/browse/researchGroup/67",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "info",
																					"flip": "",
																					"top": 54.84126984126985,
																					"left": 61.07142857142858,
																					"width": 30,
																					"transition": "popcorn-pop",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent10"
																	},
																	{
																			"id": "TrackEvent5",
																			"type": "wikipedia",
																			"popcornOptions": {
																					"start": 159.28802,
																					"end": 165.22054,
																					"target": "video-container",
																					"lang": "en",
																					"src": "Seasickness",
																					"width": 40,
																					"height": 52.38095238095239,
																					"top": 2.5396825396825395,
																					"left": 60,
																					"transition": "popcorn-fade",
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent11"
																	},
																	{
																			"id": "TrackEvent6",
																			"type": "text",
																			"popcornOptions": {
																					"start": 235.11296,
																					"end": 241.91777,
																					"target": "video-container",
																					"text": "Stuart Brown: \n\"Plenty of play in childhood makes for happy, smart adults -- and keeping it up can make us smarter at any age. \"",
																					"linkUrl": "",
																					"position": "custom",
																					"transition": "popcorn-fade",
																					"fontFamily": "PT Sans",
																					"fontSize": "6",
																					"fontColor": "#ffffff",
																					"fontDecorations": {
																							"bold": true,
																							"italics": false,
																							"underline": false
																					},
																					"left": 4.642857142857143,
																					"top": 71.42328171502976,
																					"zindex": 1000,
																					"width": 92.85714285714286
																			},
																			"track": "0",
																			"name": "TrackEvent14"
																	},
																	{
																			"id": "TrackEvent7",
																			"type": "text",
																			"popcornOptions": {
																					"start": 243.02879,
																					"end": 248.99789,
																					"target": "video-container",
																					"text": "\"It is paradoxical that many educators and parents still differentiate between a time for learning and a time for play without seeing the vital connection between them.” \n- Leo F Buscaglia",
																					"linkUrl": "",
																					"position": "custom",
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": "6",
																					"fontColor": "#fffbf6",
																					"fontDecorations": {
																							"bold": true,
																							"italics": false,
																							"underline": false
																					},
																					"left": 4.461310250418526,
																					"top": 66.66666666666666,
																					"zindex": 1000,
																					"width": 93.92857142857143
																			},
																			"track": "0",
																			"name": "TrackEvent15"
																	},
																	{
																			"id": "TrackEvent8",
																			"type": "text",
																			"popcornOptions": {
																					"start": 267.1928,
																					"end": 274.27266,
																					"target": "video-container",
																					"text": "\"Play-based learning can take a key role in the teaching of science and can encourage scientific enquiry skills\" - Robert Sinclair",
																					"linkUrl": "http://www.teachingexpertise.com/articles/playful-science-3287",
																					"position": "custom",
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": "6",
																					"fontColor": "#ffffff",
																					"fontDecorations": {
																							"bold": true,
																							"italics": false,
																							"underline": false
																					},
																					"left": 4.464285714285714,
																					"top": 77.14285714285715,
																					"zindex": 1000,
																					"width": 92.32142857142858
																			},
																			"track": "0",
																			"name": "TrackEvent16"
																	},
																	{
																			"id": "TrackEvent9",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 281.21903,
																					"end": 289.55145,
																					"target": "video-container",
																					"text": "Early Childhood News:\n\"Promoting the development of scientific thinking\"",
																					"linkUrl": "http://www.earlychildhoodnews.com/earlychildhood/article_view.aspx?ArticleId=409",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "info",
																					"flip": "",
																					"top": 58.333333333333336,
																					"left": 9.285714285714286,
																					"width": 30,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent17"
																	},
																	{
																			"id": "TrackEvent10",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 293.29809,
																					"end": 303.48165,
																					"target": "video-container",
																					"text": "Visit Blackawton School",
																					"linkUrl": "http://www.our-school.org.uk/blackawton",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "earth",
																					"flip": "",
																					"top": 80,
																					"left": 17.32142857142857,
																					"width": 32.67857142857143,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent18"
																	},
																	{
																			"id": "TrackEvent11",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 219.69815,
																					"end": 227.75282,
																					"target": "video-container",
																					"text": "Watch the TED talk\n\"Evolution's Gift of Play, from Bonobo Apes to Humans\"",
																					"linkUrl": "http://www.ted.com/talks/isabel_behncke_evolution_s_gift_of_play_from_bonobo_apes_to_humans.html",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "tv",
																					"flip": "",
																					"top": 58.333333333333336,
																					"left": 63.39285714285714,
																					"width": 30,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent13"
																	},
																	{
																			"id": "TrackEvent12",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 306.00719,
																					"end": 314.57363,
																					"target": "video-container",
																					"text": "Why Teaching Science is Important:\nwhyscience.co.uk",
																					"linkUrl": "http://whyscience.co.uk/about/index.php",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "info",
																					"flip": "",
																					"top": 74.92063492063492,
																					"left": 61.42857142857143,
																					"width": 34.82142857142857,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent20"
																	},
																	{
																			"id": "TrackEvent13",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 350.07286,
																					"end": 355.07286,
																					"target": "video-container",
																					"text": "Teaching Times: \nPrimary schools lack quality science teachers",
																					"linkUrl": "http://www.teachingtimes.com/articles/primary-schools-science-teachers.htm",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "info",
																					"flip": "",
																					"top": 31.428571428571427,
																					"left": 69.28571428571428,
																					"width": 24.285714285714285,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent22"
																	},
																	{
																			"id": "TrackEvent14",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 364.52472,
																					"end": 372.6554,
																					"target": "video-container",
																					"text": "A New Challenge for Teachers: \nEncouraging Girls in Science, Math and IT Related Studies and Careers",
																					"linkUrl": "http://ezinearticles.com/?A-New-Challenge-for-Teachers:-Encouraging-Girls-in-Science,-Math-and-IT-Related-Studies-and-Careers&amp;id=44420",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "info",
																					"flip": "",
																					"top": 71.74603174603175,
																					"left": 10.535714285714286,
																					"width": 75.71428571428571,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent23"
																	},
																	{
																			"id": "TrackEvent15",
																			"type": "text",
																			"popcornOptions": {
																					"start": 387.27773,
																					"end": 398.09279,
																					"target": "video-container",
																					"text": "\"A survey of over a thousand 8–11 year-old children in primary schools indicated that children in the more senior classes showed a marked decline in their enjoyment of school science. \" - Association for Science Education",
																					"linkUrl": "https://www.google.com/search?q=SSR308Mar2003p109.pdf&amp;ie=utf-8&amp;oe=utf-8&amp;aq=t&amp;rls=org.mozilla:en-US:official&amp;client=firefox-a",
																					"position": "custom",
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": "6",
																					"fontColor": "#ffffff",
																					"fontDecorations": {
																							"bold": true,
																							"italics": false,
																							"underline": false
																					},
																					"left": 8.214285714285714,
																					"top": 64.12698412698413,
																					"zindex": 1000,
																					"width": 86.60714285714286
																			},
																			"track": "0",
																			"name": "TrackEvent24"
																	},
																	{
																			"id": "TrackEvent16",
																			"type": "text",
																			"popcornOptions": {
																					"start": 419.8409,
																					"end": 434.96005,
																					"target": "video-container",
																					"text": "\"49% of all co-ed maintained schools in England do not send even one girl on to do physics A-level\" \n- Institute of Physics",
																					"linkUrl": "http://www.iop.org/news/12/oct/page_58519.html",
																					"position": "custom",
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": "6",
																					"fontColor": "#ffffff",
																					"fontDecorations": {
																							"bold": true,
																							"italics": false,
																							"underline": false
																					},
																					"left": 3.214285714285714,
																					"top": 77.77777777777779,
																					"zindex": 1000,
																					"width": 94.46428571428571
																			},
																			"track": "0",
																			"name": "TrackEvent25"
																	},
																	{
																			"id": "TrackEvent17",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 329.63049,
																					"end": 341.74673,
																					"target": "video-container",
																					"text": "Watch a video about Lottolab's\niScientist program for youth",
																					"linkUrl": "https://vimeo.com/17584010",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "tv",
																					"flip": "",
																					"top": 66.9047619047619,
																					"left": 65.17857142857143,
																					"width": 30,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent26"
																	},
																	{
																			"id": "TrackEvent18",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 402.53587,
																					"end": 411.55318,
																					"target": "video-container",
																					"text": "Why Science Is Vital\nscienceisvital.org.uk",
																					"linkUrl": "http://scienceisvital.org.uk/2010/09/28/key-messages/",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "info",
																					"flip": "",
																					"top": 64.04761904761904,
																					"left": 10.714285714285714,
																					"width": 30,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent21"
																	},
																	{
																			"id": "TrackEvent19",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 455.06315,
																					"end": 485.62061,
																					"target": "video-container",
																					"text": "Watch a video of Beau and\nthe students conducting research",
																					"linkUrl": "http://www.youtube.com/watch?v=vqbG05SHpoI&amp;t=3m17s",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "tv",
																					"flip": "",
																					"top": 74.91534520709325,
																					"left": 7.678571428571429,
																					"width": 32.5,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent27"
																	},
																	{
																			"id": "TrackEvent20",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 501.9546,
																					"end": 505.87931,
																					"target": "video-container",
																					"text": "Linkedin Profile of\nDave Strudwick",
																					"linkUrl": "http://uk.linkedin.com/pub/dave-strudwick/28/521/a61?trk=pub-pbmap",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "man",
																					"flip": "",
																					"top": 5,
																					"left": 20,
																					"width": 30,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent28"
																	},
																	{
																			"id": "TrackEvent21",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 506.41069,
																					"end": 511.09016,
																					"target": "video-container",
																					"text": "Read the full paper here",
																					"linkUrl": "http://rsbl.royalsocietypublishing.org/content/7/2/168.full",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "info",
																					"flip": "",
																					"top": 80.95238095238095,
																					"left": 57.85714285714286,
																					"width": 39.285714285714285,
																					"transition": "popcorn-pop",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent29"
																	},
																	{
																			"id": "TrackEvent22",
																			"type": "text",
																			"popcornOptions": {
																					"start": 517.8921,
																					"end": 521.52568,
																					"target": "video-container",
																					"text": "\"Knowing the right answer ... is not one of the primary objectives of science in the early childhood curriculum...\"",
																					"linkUrl": "",
																					"position": "custom",
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": "6",
																					"fontColor": "#ffffff",
																					"fontDecorations": {
																							"bold": true,
																							"italics": false,
																							"underline": false
																					},
																					"left": 4.642857142857143,
																					"top": 77.46031746031747,
																					"zindex": 1000,
																					"width": 90.71428571428571
																			},
																			"track": "0",
																			"name": "TrackEvent30"
																	},
																	{
																			"id": "TrackEvent23",
																			"type": "text",
																			"popcornOptions": {
																					"start": 521.82752,
																					"end": 525.29938,
																					"target": "video-container",
																					"text": "“Knowing the right answer requires no decisions, carries no risks, and makes no demands\"",
																					"linkUrl": "",
																					"position": "custom",
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": "6",
																					"fontColor": "#ffffff",
																					"fontDecorations": {
																							"bold": true,
																							"italics": false,
																							"underline": false
																					},
																					"left": 6.785714285714286,
																					"top": 77.77777777777779,
																					"zindex": 1000,
																					"width": 91.07142857142857
																			},
																			"track": "0",
																			"name": "TrackEvent31"
																	},
																	{
																			"id": "TrackEvent24",
																			"type": "text",
																			"popcornOptions": {
																					"start": 525.60122,
																					"end": 530.60122,
																					"target": "video-container",
																					"text": "\"A far more important objective is to help children realize that answers about the world can be discovered through their own investigations.\" - Eleanor Duckworth",
																					"linkUrl": "http://www.goodreads.com/book/show/684911.The_Having_of_Wonderful_Ideas",
																					"position": "custom",
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": "6",
																					"fontColor": "#ffffff",
																					"fontDecorations": {
																							"bold": true,
																							"italics": false,
																							"underline": false
																					},
																					"left": 4.642857142857143,
																					"top": 71.10582139756944,
																					"zindex": 1000,
																					"width": 93.03571428571429
																			},
																			"track": "0",
																			"name": "TrackEvent32"
																	},
																	{
																			"id": "TrackEvent25",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 565.14962,
																					"end": 573.4519,
																					"target": "video-container",
																					"text": "How to Write a Scientific Paper",
																					"linkUrl": "http://www.nmas.org/JAhowto.html",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "info",
																					"flip": "",
																					"top": 77.6984126984127,
																					"left": 64.82142857142857,
																					"width": 30,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent35"
																	},
																	{
																			"id": "TrackEvent26",
																			"type": "wikipedia",
																			"popcornOptions": {
																					"start": 640.47021,
																					"end": 645.47021,
																					"target": "video-container",
																					"lang": "en",
																					"src": "http://en.wikipedia.org/wiki/Dale_Purves",
																					"width": 41.785714285714285,
																					"height": 100.95238095238095,
																					"top": -0.9523809523809524,
																					"left": 58.214285714285715,
																					"transition": "popcorn-fade",
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent36"
																	},
																	{
																			"id": "TrackEvent27",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 650.29496,
																					"end": 657.08773,
																					"target": "video-container",
																					"text": "Larry Maloney",
																					"linkUrl": "http://www.psych.nyu.edu/maloney/",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "man",
																					"flip": "",
																					"top": 81.91534133184524,
																					"left": 70,
																					"width": 30,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent37"
																	},
																	{
																			"id": "TrackEvent28",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 664.9263,
																					"end": 672.32288,
																					"target": "video-container",
																					"text": "Read the commentary paper by \nNatalie Hempel de Ibarra and \nLaurence T. Maloney",
																					"linkUrl": "",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "info",
																					"flip": "",
																					"top": 64.12698412698413,
																					"left": 59.64285714285714,
																					"width": 33.035714285714285,
																					"transition": "popcorn-pop",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent38"
																	},
																	{
																			"id": "TrackEvent29",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 675.79206,
																					"end": 686.50955,
																					"target": "video-container",
																					"text": "Read the final published article",
																					"linkUrl": "http://rsbl.royalsocietypublishing.org/content/7/2/168.full",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "info",
																					"flip": "",
																					"top": 73.65079365079366,
																					"left": 12.5,
																					"width": 36.607142857142854,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent39"
																	},
																	{
																			"id": "TrackEvent30",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 706.58797,
																					"end": 711.58797,
																					"target": "video-container",
																					"text": "Article in The Guardian",
																					"linkUrl": "http://www.guardian.co.uk/science/blog/2010/dec/22/schoolchildren-bumble-bee-research-journal",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "net",
																					"flip": "",
																					"top": 73.88888888888889,
																					"left": 11.607142857142858,
																					"width": 30,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent40"
																	},
																	{
																			"id": "TrackEvent31",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 712.62589,
																					"end": 717.62589,
																					"target": "video-container",
																					"text": "Article in Discover Magazine",
																					"linkUrl": "http://blogs.discovermagazine.com/notrocketscience/2010/12/21/eight-year-old-children-publish-bee-study-in-royal-society-journal/",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "info",
																					"flip": "",
																					"top": 69.76190476190476,
																					"left": 64.10714285714286,
																					"width": 30,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent41"
																	},
																	{
																			"id": "TrackEvent32",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 727.26786,
																					"end": 732.26786,
																					"target": "video-container",
																					"text": "Article on BBC.co.uk ",
																					"linkUrl": "http://news.bbc.co.uk/local/devon/hi/people_and_places/nature/newsid_9312000/9312350.stm",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "net",
																					"flip": "",
																					"top": 6.031746031746032,
																					"left": 74.46428571428572,
																					"width": 20.357142857142858,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent42"
																	},
																	{
																			"id": "TrackEvent33",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 776.17504,
																					"end": 781.17504,
																					"target": "video-container",
																					"text": "\"Why Play is vital,\nno matter what your age\"\nTED 2008, Stuart Brown",
																					"linkUrl": "http://blog.ted.com/2009/03/12/stuart_brown_play/",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "tv",
																					"flip": "",
																					"top": 49.76190476190476,
																					"left": 8.928571428571429,
																					"width": 30,
																					"transition": "popcorn-pop",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent44"
																	},
																	{
																			"id": "TrackEvent34",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 845.15831,
																					"end": 850.15831,
																					"target": "video-container",
																					"text": "The Centre for Education in Science and Technology:\nImportance of science in schools",
																					"linkUrl": "http://www.cest.org.uk/importance-of-science-in-schools/",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "net",
																					"flip": "",
																					"top": 67.22222222222223,
																					"left": 8.928571428571429,
																					"width": 30,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent45"
																	},
																	{
																			"id": "TrackEvent35",
																			"type": "text",
																			"popcornOptions": {
																					"start": 853.6114,
																					"end": 857.08327,
																					"target": "video-container",
																					"text": "\"It is human to have a long childhood\"",
																					"linkUrl": "",
																					"position": "custom",
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": "6",
																					"fontColor": "#ffffff",
																					"fontDecorations": {
																							"bold": true,
																							"italics": false,
																							"underline": false
																					},
																					"left": 4.285714285714286,
																					"top": 10.952380952380953,
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent46"
																	},
																	{
																			"id": "TrackEvent36",
																			"type": "text",
																			"popcornOptions": {
																					"start": 857.23416,
																					"end": 862.21552,
																					"target": "video-container",
																					"text": "\"it is civilized to have an even longer childhood.\"\n - Erik Erikson",
																					"linkUrl": "",
																					"position": "custom",
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": "6",
																					"fontColor": "#ffffff",
																					"fontDecorations": {
																							"bold": true,
																							"italics": false,
																							"underline": false
																					},
																					"left": 4.107142857142857,
																					"top": 11.26984126984127,
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent47"
																	},
																	{
																			"id": "TrackEvent37",
																			"type": "text",
																			"popcornOptions": {
																					"start": 867.95147,
																					"end": 872.95147,
																					"target": "video-container",
																					"text": "Some studies have shown that investment in girls education raised the GDP of the entire country by 0.2%",
																					"linkUrl": "http://goodintents.org/uncategorized/skills-for-life",
																					"position": "custom",
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": "6",
																					"fontColor": "#ffffff",
																					"fontDecorations": {
																							"bold": true,
																							"italics": false,
																							"underline": false
																					},
																					"left": 1.7857142857142856,
																					"top": 79.2063492063492,
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent48"
																	},
																	{
																			"id": "TrackEvent38",
																			"type": "text",
																			"popcornOptions": {
																					"start": 873.98939,
																					"end": 878.98939,
																					"target": "video-container",
																					"text": "Children of women who have completed primary school are 40% less likely to die before age five",
																					"linkUrl": "http://goodintents.org/uncategorized/skills-for-life",
																					"position": "custom",
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": "6",
																					"fontColor": "#ffffff",
																					"fontDecorations": {
																							"bold": true,
																							"italics": false,
																							"underline": false
																					},
																					"left": 3.032738821847098,
																					"top": 81.74603174603175,
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent49"
																	},
																	{
																			"id": "TrackEvent39",
																			"type": "text",
																			"popcornOptions": {
																					"start": 881.83869,
																					"end": 886.83869,
																					"target": "video-container",
																					"text": "An extra year of primary school boosts girls’ eventual wages by 10 to 20 percent. An extra year of secondary school: 15 to 25 percent\n",
																					"linkUrl": "",
																					"position": "custom",
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": "6",
																					"fontColor": "#ffffff",
																					"fontDecorations": {
																							"bold": true,
																							"italics": false,
																							"underline": false
																					},
																					"left": 2.5,
																					"top": 79.36507936507937,
																					"zindex": 1000,
																					"width": 94.82142857142857
																			},
																			"track": "0",
																			"name": "TrackEvent50"
																	},
																	{
																			"id": "TrackEvent40",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 901.46194,
																					"end": 908.70757,
																					"target": "video-container",
																					"text": "To discover more about Dr. Beau Lotto's work\nvisit lottolab.org",
																					"linkUrl": "http://www.lottolab.org",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "net",
																					"flip": "",
																					"top": 42.142857142857146,
																					"left": 9.107142857142856,
																					"width": 30,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": "18",
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent51"
																	},
																	{
																			"id": "TrackEvent41",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 911.89226,
																					"end": 919.31217,
																					"target": "video-container",
																					"text": "To remix this video with \nPopcorn Maker, click here!",
																					"linkUrl": "https://popcorn.webmaker.org/templates/basic/?savedDataUrl=ted.json",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "thumbsup",
																					"flip": "",
																					"top": 31.349206349206348,
																					"left": 66.78571428571428,
																					"width": 30,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": "18",
																					"fontColor": "#000000",
																					"fontDecorations": {
																							"bold": true,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent52"
																	},
																	{
																			"id": "TrackEvent42",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 5.51771,
																					"end": 10.51771,
																					"target": "video-container",
																					"text": "Some text will include links \n- for example, this links to the original on TED.com",
																					"linkUrl": "http://www.youtube.com/watch?v=0g2WE1qXiKM",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "error",
																					"flip": "",
																					"top": 74.92063492063492,
																					"left": 14.821428571428571,
																					"width": 77.14285714285715,
																					"transition": "popcorn-pop",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent48"
																	},
																	{
																			"id": "TrackEvent43",
																			"type": "twitter",
																			"popcornOptions": {
																					"start": 172.42847,
																					"end": 201.24143,
																					"target": "video-container",
																					"search": "#uncertainty",
																					"username": "",
																					"searchType": "mixed",
																					"numberOfTweets": "50",
																					"transition": "popcorn-fade",
																					"layout": "ticker",
																					"left": 0,
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent51"
																	},
																	{
																			"id": "TrackEvent44",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 46.79577,
																					"end": 51.79577,
																					"target": "video-container",
																					"text": "Click here to watch Beau's\n2009 TED talk\n\"Optical illusions show how we see\"",
																					"linkUrl": "http://www.ted.com/talks/beau_lotto_optical_illusions_show_how_we_see.html",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "tv",
																					"flip": "",
																					"top": 56.74603174603175,
																					"left": 61.7827388218471,
																					"width": 30,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": 12,
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent5"
																	},
																	{
																			"id": "TrackEvent45",
																			"type": "image",
																			"popcornOptions": {
																					"start": 16.85484,
																					"end": 21.85484,
																					"target": "video-container",
																					"src": "http://www.ucl.ac.uk/~uccaati/UCLlogo.jpg",
																					"linkSrc": "",
																					"tags": "",
																					"photosetId": "",
																					"count": 3,
																					"width": 25,
																					"height": 25,
																					"top": 26.026456318204367,
																					"left": 75,
																					"transition": "popcorn-fade",
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent56"
																	},
																	{
																			"id": "TrackEvent46",
																			"type": "text",
																			"popcornOptions": {
																					"start": 555.69474,
																					"end": 557.95899,
																					"target": "video-container",
																					"text": "The George Inn, \nBlackawton",
																					"linkUrl": "",
																					"position": "custom",
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": "6",
																					"fontColor": "#ffffff",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"left": 13.211310250418526,
																					"top": 83.33333333333334,
																					"zindex": 1000,
																					"width": 50
																			},
																			"track": "0",
																			"name": "TrackEvent34"
																	},
																	{
																			"id": "TrackEvent47",
																			"type": "wikipedia",
																			"popcornOptions": {
																					"start": 59.82126,
																					"end": 64.82126,
																					"target": "video-container",
																					"lang": "en",
																					"src": "http://en.wikipedia.org/wiki/Perception",
																					"width": 44.82142857142858,
																					"height": 86.66666666666667,
																					"top": 13.333333333333334,
																					"left": 0,
																					"transition": "popcorn-fade",
																					"zindex": 1000
																			},
																			"track": "0",
																			"name": "TrackEvent6"
																	}
															]
													},
													{
															"name": "Layer 1",
															"id": "1",
															"trackEvents": [
																	{
																			"id": "TrackEvent48",
																			"type": "googlemap",
																			"popcornOptions": {
																					"start": 293.51157,
																					"end": 303.32024,
																					"target": "video-container",
																					"type": "ROADMAP",
																					"location": "",
																					"fullscreen": false,
																					"heading": 0,
																					"pitch": 1,
																					"zoom": 11,
																					"transition": "popcorn-fade",
																					"left": 0.8928571428571428,
																					"top": 27.936507936507937,
																					"width": 36.25,
																					"height": 52.38095238095239,
																					"lat": 50.34691535671606,
																					"lng": -3.6859852275390526,
																					"zindex": 999
																			},
																			"track": "1",
																			"name": "TrackEvent53"
																	},
																	{
																			"id": "TrackEvent49",
																			"type": "googlemap",
																			"popcornOptions": {
																					"start": 555.71524,
																					"end": 558.01414,
																					"target": "video-container",
																					"type": "ROADMAP",
																					"location": "The George Inn Blackawton UK",
																					"fullscreen": "",
																					"heading": 0,
																					"pitch": 1,
																					"zoom": 16,
																					"transition": "popcorn-fade",
																					"left": 51.60714285714286,
																					"top": 48.888888888888886,
																					"width": 40.2332361516035,
																					"height": 50.79365079365079,
																					"lat": 50.34494353136311,
																					"lng": -3.681629320098867,
																					"zindex": 999
																			},
																			"track": "1",
																			"name": "TrackEvent54"
																	},
																	{
																			"id": "TrackEvent50",
																			"type": "image",
																			"popcornOptions": {
																					"start": 46.76733,
																					"end": 51.76733,
																					"target": "video-container",
																					"src": "http://i.ytimg.com/vi/dQsYtF3wnIs/0.jpg",
																					"linkSrc": "",
																					"tags": "",
																					"photosetId": "",
																					"count": 3,
																					"width": 30.892857142857146,
																					"height": 46.34920634920635,
																					"top": 14.920634920634921,
																					"left": 62.857142857142854,
																					"transition": "popcorn-fade",
																					"zindex": 999
																			},
																			"track": "1",
																			"name": "TrackEvent57"
																	},
																	{
																			"id": "TrackEvent51",
																			"type": "text",
																			"popcornOptions": {
																					"start": 173.15049,
																					"end": 202.11671,
																					"target": "video-container",
																					"text": "What the world feels now about #uncertainty:",
																					"linkUrl": "",
																					"position": "custom",
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": "6",
																					"fontColor": "white",
																					"fontDecorations": {
																							"bold": true,
																							"italics": false,
																							"underline": false
																					},
																					"left": 2.5,
																					"top": 67.77777777777779,
																					"zindex": 999,
																					"width": 50
																			},
																			"track": "1",
																			"name": "TrackEvent52"
																	},
																	{
																			"id": "TrackEvent52",
																			"type": "popup",
																			"popcornOptions": {
																					"start": 227.68817,
																					"end": 234.278,
																					"target": "video-container",
																					"text": "Scientific American:\n\"So you think you know why animals play\"",
																					"linkUrl": "http://blogs.scientificamerican.com/guest-blog/2011/05/17/so-you-think-you-know-why-animals-play/ ",
																					"type": "popup",
																					"triangle": "bottom left",
																					"sound": "",
																					"icon": "info",
																					"flip": "",
																					"top": 65.63492063492063,
																					"left": 63.035714285714285,
																					"width": 30,
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": "12",
																					"fontColor": "#668B8B",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"zindex": 999
																			},
																			"track": "1",
																			"name": "TrackEvent19"
																	},
																	{
																			"id": "TrackEvent53",
																			"type": "image",
																			"popcornOptions": {
																					"start": 22.25405,
																					"end": 27.2528,
																					"target": "video-container",
																					"src": "http://stephaniejerey.com/img/holding/lotto-lab.png",
																					"linkSrc": "http://www.lottolab.org/index.asp",
																					"tags": "",
																					"photosetId": "",
																					"count": 3,
																					"width": 25,
																					"height": 25,
																					"top": 35.86772615947421,
																					"left": 75,
																					"transition": "popcorn-fade",
																					"zindex": 999
																			},
																			"track": "1",
																			"name": "TrackEvent55"
																	}
															]
													},
													{
															"name": "Layer 2",
															"id": "2",
															"trackEvents": [
																	{
																			"id": "TrackEvent54",
																			"type": "image",
																			"popcornOptions": {
																					"start": 555.72035,
																					"end": 558.06679,
																					"target": "video-container",
																					"src": "http://www.blackawton.com/images/pub.jpg",
																					"linkSrc": "",
																					"tags": "",
																					"photosetId": "",
																					"count": 3,
																					"width": 82.32142857142857,
																					"height": 100,
																					"top": 0,
																					"left": 11.071428571428571,
																					"transition": "popcorn-fade",
																					"zindex": 998
																			},
																			"track": "2",
																			"name": "TrackEvent33"
																	}
															]
													},
													{
															"name": "Layer 3",
															"id": "3",
															"trackEvents": [
																	{
																			"id": "TrackEvent55",
																			"type": "text",
																			"popcornOptions": {
																					"start": 16.86542,
																					"end": 21.86542,
																					"target": "video-container",
																					"text": "Dr. Beau Lotto is a professor\nat University College London\nin the Department of Opthamology",
																					"linkUrl": "",
																					"position": "custom",
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": "6",
																					"fontColor": "white",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"left": 47.85714285714286,
																					"top": 51.746031746031754,
																					"width": 50,
																					"zindex": 997
																			},
																			"track": "3",
																			"name": "TrackEvent58"
																	},
																	{
																			"id": "TrackEvent56",
																			"type": "text",
																			"popcornOptions": {
																					"start": 22.31474,
																					"end": 27.27271,
																					"target": "video-container",
																					"text": "Beau is also the Head Misfit\nand founder of Lottolab.org",
																					"linkUrl": "",
																					"position": "custom",
																					"transition": "popcorn-fade",
																					"fontFamily": "Merriweather",
																					"fontSize": "6",
																					"fontColor": "white",
																					"fontDecorations": {
																							"bold": false,
																							"italics": false,
																							"underline": false
																					},
																					"left": 45,
																					"top": 62.857142857142854,
																					"width": 49.28571428571429,
																					"zindex": 997
																			},
																			"track": "3",
																			"name": "TrackEvent59"
																	}
															]
													}
											]
									}
							],
							"name": "ted",
							"template": "basic"
					}
					var c = {"template":"basic","author":"TODO","thumbnail":"http://ep01.epimg.net/elpais/imagenes/2015/10/19/ciencia/1445271172_891155_1445332934_portada_normal.jpg","background":"#000000","data":{"targets":[{"id":"Target0","name":"video-container","element":"video-container"}],"media":[{"id":"Media0","name":"Media0","url":"#t=,95.30082194276893","target":"video","duration":95.30082194276893,"popcornOptions":{"frameAnimation":true},"controls":true,"tracks":[{"name":"Texto","id":"2","order":0,"trackEvents":[{"id":"TrackEventTrackEventTrackEvent3","type":"text","popcornOptions":{"start":0,"end":92.54082,"target":"video-container","text":"MDCAT test","linkUrl":"","linkTarget":"_blank","position":"custom","alignment":"right","transition":"popcorn-fade","fontFamily":"Open Sans","fontSize":10,"fontColor":"#f3f2f2","shadow":true,"shadowColor":"#444444","background":false,"backgroundColor":"#888888","fontDecorations":{"bold":false,"italics":false},"left":48.12599681020734,"top":86.76236044657098,"width":49.920255183413076,"zindex":1000,"id":"TrackEventTrackEventTrackEvent3"},"track":"2","name":"TrackEvent3"}]},{"name":"v2","id":"4","order":1,"trackEvents":[{"id":"TrackEventTrackEventTrackEvent1","type":"sequencer","popcornOptions":{"start":0,"source":["http://bancmemorial.gencat.cat/dedalo/media/av/404/2.mp4?vbegin=145&vend=250&butteruid=1445351412809"],"fallback":"","denied":false,"end":34.66908,"from":0,"title":"2.mp4?vbegin=145&vend=250","type":"HTML5","thumbnailSrc":"http://bancmemorial.gencat.cat/dedalo/media/av/404/2.mp4?vbegin=145&vend=250&butteruid=1445351412807","duration":102.48,"linkback":"","contentType":"video/mp4","hidden":false,"target":"video-container","left":0,"top":-0.0886053517632465,"width":76.39553429027113,"height":100.08860535176325,"volume":100,"mute":false,"zindex":999,"id":"TrackEventTrackEventTrackEvent1"},"track":"4","name":"TrackEvent1"}]},{"name":"v525","id":"3","order":2,"trackEvents":[{"id":"TrackEventTrackEventTrackEvent2","type":"sequencer","popcornOptions":{"start":34.63443232251578,"end":95.30082194276893,"source":["http://bancmemorial.gencat.cat/dedalo/media/av/404/525.mp4?vbegin=145&vend=250&butteruid=1445351412810"],"fallback":"","denied":false,"from":0,"title":"525.mp4?vbegin=145&vend=250","type":"HTML5","thumbnailSrc":"http://bancmemorial.gencat.cat/dedalo/media/av/404/525.mp4?vbegin=145&vend=250&butteruid=1445351412805","duration":105.604354,"linkback":"","contentType":"video/mp4","hidden":false,"target":"video-container","width":100,"height":100,"top":0,"left":0,"volume":100,"mute":false,"zindex":998,"id":"TrackEventTrackEventTrackEvent2"},"track":"3","name":"TrackEvent2"}]}],"clipData":{"http://bancmemorial.gencat.cat/dedalo/media/av/404/525.mp4?vbegin=145&vend=250":{"source":"http://bancmemorial.gencat.cat/dedalo/media/av/404/525.mp4?vbegin=145&vend=250","type":"HTML5","title":"525.mp4?vbegin=145&vend=250","thumbnail":"http://bancmemorial.gencat.cat/dedalo/media/av/404/525.mp4?vbegin=145&vend=250&butteruid=1445351412805","contentType":"video/mp4","duration":105.604354},"http://bancmemorial.gencat.cat/dedalo/media/av/404/2.mp4?vbegin=145&vend=250":{"source":"http://bancmemorial.gencat.cat/dedalo/media/av/404/2.mp4?vbegin=145&vend=250","type":"HTML5","title":"2.mp4?vbegin=145&vend=250","thumbnail":"http://bancmemorial.gencat.cat/dedalo/media/av/404/2.mp4?vbegin=145&vend=250&butteruid=1445351412807","contentType":"video/mp4","duration":102.48}},"currentTime":0}]},"tags":["mdcat"]}
					//PopcornEditor.loadInfo(JSON.parse(a));
					PopcornEditor.loadInfo(c);
					//console.log(a);
				}


			 PopcornEditor.init('editor'); 
		</script>
	</body>
</html>