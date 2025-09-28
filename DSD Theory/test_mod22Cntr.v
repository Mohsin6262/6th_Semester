module test_mod22Cntr;

	reg clock;
	reg reset;
	wire[4:0] out;
	
	mod22Cntr c1 (.ck(clock), .rst(reset), .O(out));

	always
		#5 clock = ~clock;

	initial
	begin
		clock = 1'b0; 
		reset = 1'b1;
		#7
		reset = 1'b0;
		#400 $finish; 
	end

	initial
		$monitor($time, " Count = %b", out);

endmodule