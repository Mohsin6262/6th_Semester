// Clock Divider to generate 3-second pulse from 100 MHz input clock
module Clock_Divider (
    input clock_in,
    output reg clock_out = 0
);
    reg [27:0] counter = 28'd0;
    parameter DIVISOR = 28'd300_000_000; // 3 seconds @ 100 MHz

    always @(posedge clock_in) begin
        if (counter >= DIVISOR - 1) begin
            counter <= 0;
            clock_out <= 1;
        end else begin
            counter <= counter + 1;
            clock_out <= 0;
        end
    end
endmodule

// Traffic Light Controller (FSM)
module Traffic_Controller (
    input clk,               // 3-second pulse
    output reg [2:0] Hout,   // Highway LEDs
    output reg [2:0] Fout    // Farm Road LEDs
);
    // State Encoding
    parameter HG_FR = 2'b00; // Highway Green, Farm Red
    parameter HR_FY = 2'b01; // Highway Red, Farm Yellow
    parameter HR_FG = 2'b10; // Highway Red, Farm Green
    parameter HY_FR = 2'b11; // Highway Yellow, Farm Red

    reg [1:0] state = HG_FR;

    // Sequential State Transition
    always @(posedge clk) begin
        case (state)
            HG_FR: state <= HR_FY;
            HR_FY: state <= HR_FG;
            HR_FG: state <= HY_FR;
            HY_FR: state <= HG_FR;
            default: state <= HG_FR;
        endcase
    end

    // Combinational Output Logic
    always @(*) begin
        case (state)
            HG_FR: begin Hout = 3'b001; Fout = 3'b100; end // H=Green, F=Red
            HR_FY: begin Hout = 3'b100; Fout = 3'b010; end // H=Red, F=Yellow
            HR_FG: begin Hout = 3'b100; Fout = 3'b001; end // H=Red, F=Green
            HY_FR: begin Hout = 3'b010; Fout = 3'b100; end // H=Yellow, F=Red
            default: begin Hout = 3'b000; Fout = 3'b000; end
        endcase
    end
endmodule

// Top-Level Module to Connect Divider and FSM
module TopModule (
    input clk,              // 100 MHz clock
    output [2:0] Hout,      // Highway LEDs
    output [2:0] Fout       // Farm Road LEDs
);
    wire slow_clk;

    // Instantiate 3-second clock divider
    Clock_Divider div_inst (
        .clock_in(clk),
        .clock_out(slow_clk)
    );

    // Instantiate FSM controller
    Traffic_Controller fsm_inst (
        .clk(slow_clk),
        .Hout(Hout),
        .Fout(Fout)
    );
endmodule
