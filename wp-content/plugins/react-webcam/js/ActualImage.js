var ActualImage = React.createClass({

	getInitialState: function() {
		return { url: global.initialImageUrl };
	},

	refreshImage: function() {

		var xhr = new XMLHttpRequest();
		xhr.open('GET', encodeURI(global.ajaxUrl + '?action=last_image'));
		xhr.onload = function() {
			if (xhr.status === 200) {
				this.setState({ url: global.webcamUrl + xhr.responseText });
			}
		}.bind(this);
		xhr.send();

	},

	componentDidMount: function() {
		this.interval = setInterval(this.refreshImage, global.refreshInterval*1000);
	},

	componentWillUnmount: function() {
		clearInterval(this.interval);
  	},

	render: function() {
		return (
			React.createElement('img', { src: this.state.url })
		);
	}

});

React.render(React.createElement(ActualImage, null), document.getElementById('webcam'));