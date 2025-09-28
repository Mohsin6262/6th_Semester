// Clock Divider Module
module Clock_Divider (
    input clock_in,
    output reg clock_out = 0
);
    reg [29:0] counter = 30'd0;
    parameter DIVISOR = 30'd1000000000; // Adjust as needed for 10s at 100MHz

    always @(posedge clock_in) begin
        if (counter == DIVISOR - 1) begin
            counter <= 0;
            clock_out <= ~clock_out;
        end else begin
            counter <= counter + 1;
        end
    end
endmodule

// Traffic Light Controller
module TrafficLight(
    input clk,
    output reg [2:0] light
);
    // State encoding
    parameter S0 = 2'b00;
    parameter S1 = 2'b01;
    parameter S2 = 2'b10;

    // Light signals
    parameter RED   = 3'b100;
    parameter YELLOW = 3'b001;
    parameter GREEN  = 3'b010;

    reg [1:0] state = S0; // Initial state
    wire slow_clock;

    // Instantiate Clock Divider (positional association)
    Clock_Divider d1(clk, slow_clock);

    // State transition
    always @(posedge slow_clock) begin
        case(state)
            S0: state <= S1;
            S1: state <= S2;
            S2: state <= S0;
            default: state <= S0;
        endcase
    end

    // Output logic
    always @(state) begin
        case(state)
            S0: light <= RED;
            S1: light <= YELLOW;
            S2: light <= GREEN;
            default: light <= RED;
        endcase
    end
endmodule

// Top Module
module TopModule(
    input clk,
    output [2:0] light
);
    // Instantiate TrafficLight controller (positional association)
    TrafficLight t1(clk, light);
endmodule
