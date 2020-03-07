<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
<script src="{{URL::asset('scripts/extras.1.1.0.min.js')}}"></script>
<script src="{{URL::asset('scripts/shards-dashboards.1.1.0.min.js')}}"></script>
<script src="{{URL::asset('scripts/app/app-blog-overview.1.1.0.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@stack('page-scripts')
@php
$route = array_filter(explode('/', URL::current()));
@endphp
@if($route[3] == 'campus') 
<script src="https://unpkg.com/@feathersjs/client@^4.3.0/dist/feathers.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>


    <script>

      // Socket.io setup
      const socket = io('https://university-quarter-socket.herokuapp.com/');
      let formCount = 0;

      // Init feathers app
      const app = feathers();

      let tableRow = document.querySelector('#table-row');

      // Register socket.io to talk to server
      app.configure(feathers.socketio(socket));
		toastr.options.showMethod    = 'slideDown';
		toastr.options.closeDuration = 30;

		let updateNotification = (formData, count) => {
			$('#count-new-form').html(count);
			$('#new-form-notification').append(`
 				<a class="dropdown-item" href="/campus/campus-form/${formData.id}/edit">
                      <div class="notification__icon-wrapper">
                        <div class="notification__icon">
                          <i class="material-icons">&#xE8D1;</i>
                        </div>
                      </div>
                      <div class="notification__content">
                        <span class="notification__category">${formData.title}</span>
                        <p>${formData.description}</p>
                      </div>
                    </a>
                    <a class="dropdown-item notification__all text-center" href="#"> View all Notifications </a>
			`);
		};


		

	    socket.on('publish_unified_form', function (data) {
	    	formCount++;
	    	updateNotification(data, formCount);
			toastr.info(`Administrator upload new unified form ${data.title} - ${data.description}`);

	    	let status = `<span class='badge badge-primary'>Deadline</span>`;
	    	if (parseInt(data.status) == 0) {
	    		status = `<span class='badge badge-danger'>Need to submit</span>`;
	    	}

	    	tableRow.innerHTML += `
	    	<tr style='background : #dee2e6;'>
	    		<td>${data.title}</td>
				<td>${data.description}</td>
				<td>${data.quarter}</td>
				<td class='font-weight-bold text-primary'>${data.created_at}</td>
				<td class='font-weight-bold text-danger'>${data.deadline}</td>
				<td><span class='badge badge-primary'>${data.days_left}</span></td>
				<td>${status}</td>
				<td>
					<a href="${data.link}" class='btn btn-primary'>Download</a>
					<a href="/campus/campus-form/${data.id}/edit" class='btn btn-success'>Submit Form</a>
				</td>
	    	</tr>
	    	`;
	    });


     

      /*async function init() {
        // Find ideas
        const ideas = await app.service('ideas').find();

        // Add existing ideas to list
        ideas.forEach(renderIdea);

        // Add idea in realtime
        app.service('ideas').on('created', renderIdea);
      }

      init();*/
    </script>
@endif
</body>
</html>
