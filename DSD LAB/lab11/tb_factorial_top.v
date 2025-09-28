`timescale 1ns / 1ps

module tb_factorial_top;
    reg clk;
    reg reset;
    reg start;
    reg [3:0] A_in, B_in;
    wire [7:0] result;

    // Instantiate the top-level factorial module
    factorial_top dut (
        .clk(clk),
        .reset(reset),
        .start(start),
        .A_in(A_in),
        .B_in(B_in),
        .result(result)
    );

    // Generate clock: 100 MHz (10 ns period)
    initial clk = 0;
    always #5 clk = ~clk;

    initial begin
        // Initial values
        reset = 1;
        start = 0;
        A_in = 4'd0;
        B_in = 4'd0;

        // Hold reset
        #20;
        reset = 0;

        // Load input number for factorial calculation (e.g., 5! = 120)
        B_in = 4'd5;

        // Start the FSM
        #10;
        start = 1;
        #10;
        start = 0;

        // Wait enough time for factorial to complete
        #2000;

        $display("Final Result at Time=%0t is: %d", $time, result);
    end

    // Optional monitor for simulation output
   initial begin
    $monitor("Time=%0t | FSM state=%b | B_reg=%d | factorial=%d | Result=%d", 
             $time, uut_fsm.state, uut_factorial.B_reg, uut_factorial.factorial, result);
end


endmodule
